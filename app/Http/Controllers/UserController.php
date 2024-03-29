<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use App\Models\AdminResidents;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use App\Models\barangayOfficial;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ResidentsRegistration;
use Twilio\Rest\Client;
use App\Http\Controllers\Helper\ActivityLog;
use App\Models\ActivityLog as ModelsActivityLog;

class UserController extends Controller
{

    public function register(){
        return view('/register');
    }

    public function register2(){
      return view('/register2');
  }

  public function uploadImg(){
    return view('/uploadImg');
}


     //View User Profile
     public function myProfile(){
        $profile = Auth::user()->adminResidents;
        // dd($profile);
        return view('user.Profile',['profile'=>$profile]);
    }

     //View Form User Profile
     public function editProfile(){
        $profile = Auth::user()->adminResidents;
        // dd($profile);
        return view('user.editProfile',['profile'=>$profile]);
    }

     //View list of Officials to manage admin
 public function listOfficials(){
    return view('Admin.Manage_Admin.listOfficials');
}

    //Profile Update
    public function updateProfile(Request $request ){

        $this->validate($request,[
            'first_name' =>'required',
            'middle_name' =>'required',
            'last_name' =>'required',
            'nickname' =>'required',
            'place_of_birth' =>'required',
            'birthdate' => 'required',
            'age' =>['required','numeric'],
            'civil_status' => 'required',
            'street' => 'required',
            'house_no' => 'required',
            'gender' => 'required',
            'voter_status' => 'required',
            'citizenship' => 'required',
            'email' => '',
            'phone_number' => ['required','numeric','digits:11'],
            'occupation' =>'required',
            'work_status' =>'required',
            'resident_image' =>['required','image'],

        ]);
        $pass = bcrypt($request->password);

        if($request->hasFile('resident_image')){
            $image= $request->file('resident_image')->store('images', 'public');
        }
        else{
            $image = $request->old_resident_image;
        }

        $user=auth()->user();

        $user->adminResidents()->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'place_of_birth' => $request->place_of_birth,
            'birthdate' => $request->birthdate,
            'age' => $request->age,
            'civil_status' => $request->civil_status,
            'street' => $request->street,
            'house_no' => $request->house_no,
            'gender' => $request->gender,
            'voter_status' => $request->voter_status,
            'citizenship' => $request->citizenship,
            'phone_number' => $request->phone_number,
            'occupation' => $request->occupation,
            'work_status' => $request->work_status,
            'resident_image' => $image,
            'password'=>$request->password

        ]);

        ActivityLog::log(
            ' updated the profile of ' . $user->first_name . ' ' . $user->last_name,
            'admin_residents',
            $user->id
          );

        return redirect('/myProfile')->with('message', 'Profile Updated Sucessfully');
}



     //Register Admin Residents Storing Data
     public function registerStore(Request $request){
        $this->validate($request,[
            'first_name' =>'required',
            'middle_name' =>'required',
            'last_name' =>'required',
            'nickname' =>'required',
            'place_of_birth' =>'required',
            'birthdate' => 'required',
            'age' =>['required','numeric', 'max:120'],
            'civil_status' => 'required',
            'street' => 'required',
            'house_no' => ['required','numeric'],
            'gender' => 'required',
            'voter_status' => 'required',
            'citizenship' => 'required',
            'email' => '',
            'username' => ['required', Rule::unique('users','username')],
            'phone_number' => ['required','numeric','digits:11'],
            'occupation' =>'required',
            'work_status' =>'required',
            'resident_image' =>['required','image'],
            'id_image' =>['required','image'],
            'password' =>['required','confirmed', 'min:6'],
            'userType' =>'required',
            'status' =>'required',

        ]);
        $pass = bcrypt($request->password);

        // if($request->hasFile('profile_image','&&', 'image_id-birth')){
        //     $formFields['profile_image'] = $request->file('profile_image')->store('images', 'public');
        //     $formFields['image_id_birth'] = $request->file('image_id_birth')->store('images', 'public');
        // }
        if($request->hasFile('resident_image')){
            $image1= $request->file('resident_image')->store('images', 'public');
        }
        if($request->hasFile('id_image')){
            $image2= $request->file('id_image')->store('images', 'public');
        }

        $user = new User();
        $user->username =$request -> username;
        $user->password = $pass;
        $user->userType =$request ->  userType;
        $user->status =$request -> status;
        $user ->save();

          $user->adminResidents()->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'place_of_birth' => $request->place_of_birth,
            'birthdate' => $request->birthdate,
            'age' => $request->age,
            'civil_status' => $request->civil_status,
            'street' => $request->street,
            'house_no' => $request->house_no,
            'gender' => $request->gender,
            'voter_status' => $request->voter_status,
            'citizenship' => $request->citizenship,
            'phone_number' => $request->phone_number,
            'occupation' => $request->occupation,
            'work_status' => $request->work_status,
            'resident_image' => $image1,
            'id_image' => $image2,
            'status' => $request->status,
            'email' => $request->email,
        ]);

        return back()->with('message', 'Registration Complete');

}

//Residents registration
public function registration(){

    $reg = AdminResidents::where('status', '=', '0')->paginate(10);
    return view('Admin.Registration.registration',['reg'=>$reg]);

}

 //View Residents
 public function viewRegistration($id){

    $reg = AdminResidents::find($id);

    return view('Admin.Registration.viewRegistration', ['reg'=>$reg]);

}

public function acceptRegistration(Request $request, $id){

    $this->validate($request,[
        'verify' =>['required', new MatchOldPassword],

    ]);
    $verify=$request->input('verify');
    $hashedPassword = Auth::user()->getAuthPassword();
    if (Hash::check($verify, $hashedPassword)) {

    $receiver_number=$request->num;
    $message = $request->message;

    $residents=AdminResidents::find($id);
    $status = 1;

    $currentTime = Carbon::now();

    AdminResidents::where('id', $id)->update(['status' => $status]);

    try {

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");

          $client = new Client($account_sid, $auth_token);
           $client->messages->create($receiver_number, [
          'from' => $twilio_number,
          'body' => $currentTime->toDateTimeString() . $message]);

       } catch (Exception $e) {
         return $e->getMessage();
    }

    ActivityLog::log(
        ' accepted the registration of '. $residents->first_name .' '. $residents->last_name,
        'admin_residents',
        $residents->id,
      );

    return redirect('/residents')->with('message', 'Registration Accepted and Notification have been Sent');
}
}

    //Cancel Registration
    public function cancelRegistration(Request $request, $id)
    {
        $receiver_number=$request->regNumber;
        $message = $request->regMessage;

        $residents=AdminResidents::find($id);
        $status = 4;

        AdminResidents::where('id', $id)->update(['status' => $status]);

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

              $client = new Client($account_sid, $auth_token);
               $client->messages->create($receiver_number, [
              'from' => $twilio_number,
              'body' => $message]);

           } catch (Exception $e) {
             return $e->getMessage();
        }

        ActivityLog::log(
            'cancelled the registration of ' . $residents->first_name . ' ' . $residents->last_name ,
            'residents_registrations',
            $residents->id,
          );

        return redirect('/registration')->with('message', 'Residents Registration Cancelled and Notification have been Sent');
    }

public function activityLog(Request $request)
{
  $request->validate([
    'search' => 'nullable|string',
    'perPage' => 'nullable|integer',
    'page' => 'nullable|integer',
    'sortBy' => 'nullable|string',
  ]);

  $perPage = $request->perPage ?? 10;
  $sort = explode(' ',  $request->sortBy ?? 'created_at desc');
  $column = $sort[0];
  $direction = $sort[1];

  $logs = ModelsActivityLog::when($request->search, function ($query, $search) {
    return $query->where('action', 'like', '%' . $search . '%');
  })
    ->orderBy($column, $direction)
    ->paginate($perPage);
  return view('admin.activitylog', ['logs' => $logs]);
}

public function manageAdmin(){
    $ad = barangayOfficial::all()->where('status','=','1');
    return view('Admin.Manage_Admin.manageAdmin', ['ad'=>$ad]);

}

 //Delete Admin
 public function deleteAdmin($id)
 {
    $status = 0;
    barangayOfficial::where('id', $id)->update(['status' => $status]);
  return back()->with('message', 'Admin Record Deleted');
}

 //Add Admins Storing Data
 public function addAdmin(Request $request, $id){
    $this->validate($request,[
        'verify' =>['required', new MatchOldPassword],
    ]);

    $verify=$request->input('verify');
    $hashedPassword = Auth::user()->getAuthPassword();
    if (Hash::check($verify, $hashedPassword)) {

    $officials=barangayOfficial::find($id);
    $status = 1;

    barangayOfficial::where('id', $id)->update(['status' => $status]);

  return redirect('/manageAdmin')->with('message', 'Admin Created Successfuly');
    }
}


public function adminLogs(){
    return view('Admin.Manage_Admin.admin_logs', [
        'log' => AdminLog::get()
    ]);
}


public function logout(Request $request) {
    auth()->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();
    ActivityLog::log(
        'logged out' .
          $request->username .
          ' ' . 'dashboard.',
        'admin_residents'
      );
    return redirect('/');
}

 //Login Page
 public function login(){

 return view('loginPage');
}

//Login
public function userLogin(Request $request){
    $user = $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    if(auth()->attempt($user)) {
        $request->session()->regenerate();
    {
        if(auth()->user()->userType =='0' && auth()->user()->admin->status=='1')
        {
            ActivityLog::log(
                'logged in ' .
                  $request->username .
                  ' ' . 'dashboard',
                'admin_residents'
              );
         return redirect('/dashboard')->with(['message' => "You are now Logged In {$request->username}!"]);
        }
        else if(auth()->user()->userType =='1' && auth()->user()->adminResidents->status=='1')
        {
         return redirect('/home');
        }
    }
}
return back()->withErrors(['password' => 'Invalid Credentials'])->onlyInput('password');
}

}
