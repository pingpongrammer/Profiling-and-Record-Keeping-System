<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @foreach($setting as $settings)
    <title>{{$settings->barangay_name}}</title>
    @endforeach
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<style>
  body{
    background-image: url("assets/img4.jpg");
}

.registration-form{
	padding: 50px 0;
}

.registration-form form{
    background-color: #fff;
    max-width: 900px;
    margin: auto;
    padding: 50px 70px;
    border-radius: 30px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
}

.registration-form .form-icon{
	text-align: center;
    background-color: #5891ff;
    border-radius: 50%;
    font-size: 40px;
    color: white;
    width: 100px;
    height: 100px;
    margin: auto;
    margin-bottom: 50px;
    line-height: 100px;
}

.registration-form .item{
	border-radius: 20px;
    padding: 6px 20px;
}

.registration-form .create-account{
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    background-color: #5791ff;
    border: none;
    color: white;
    margin-top: 20px;
}

.alert{
    background: cyan;
    padding: 20px 40px;
    min-width: 420px;
    position: absolute;
    right: 0px;
    top: 10px;
    border-radius: 4px;
    border-left: 8px solid #ffa502;
    color:black;
    }


@media (max-width: 576px) {
    .registration-form form{
        padding: 50px 20px;
    }

    .registration-form .form-icon{
        width: 70px;
        height: 70px;
        font-size: 30px;
        line-height: 70px;
    }
}
</style>

@if(session()->has('message'))
<div class="alert" id="alert">
<button type="button" class="close" data-dismiss="alert">x</button>
{{session()->get('message')}}

</div>
@endif

<body>
    <div class="registration-form">
        <form  method="POST" enctype="multipart/form-data"  action="/register" >
          @csrf
            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
        <div class="row mb-4">
          <div class="form-group col-sm-4">
              <input type="text" class="form-control item" name="first_name" id="first_name" placeholder="First name"  value="{{old('first_name')}}">
              @Error('first_name')
              <p class="text-danger text-md mt-1">{{$message}}</p>
             @enderror
          </div>
            <div class="form-group col-sm-4">
                <input type="text" class="form-control item" name="middle_name" id="middle_name" placeholder="Middle Name"  value="{{old('middle_name')}}">
                @Error('middle_name')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
            <div class="form-group col-sm-4">
                <input type="text" class="form-control item" name="last_name" id="last_name" placeholder="Last Name"  value="{{old('last_name')}}">
                @Error('last_name')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
        </div>
        <div class="row mb-4">
            <div class="form-group col-sm-4">
                <input type="text" class="form-control item" name="nickname" id="nickname" placeholder="Nickname" value="{{old('nickname')}}">
                @Error('nickname')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
              <div class="form-group col-sm-4">
                  <input type="text" class="form-control item" name="place_of_birth" id="place_of_birth" placeholder="Place of Birth" value="{{old('place_of_birth')}}">
                  @Error('place_of_birth')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>

              <div class="form-group col-sm-4">
                <input type="text" class="form-control item" name="birthdate" id="nu_datebirth" placeholder="Birthdate" value="{{old('birthdate')}}">
                @Error('birthdate')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
        </div>
        <div class="row mb-4">
              <div class="form-group col-sm-4">
                  <input readonly type="text" class="form-control item" name="age" id="a_ge" placeholder="Age" value="{{old('age')}}">
                  @Error('age')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>
            <div class="form-group col-sm-4">
                <select class="form-control item" name="civil_status" value="{{old('civil_status')}}" required autocomplete="voter_status" value="{{old('nickname')}}">
                    <option value="">-Select Civil Status-</option>
                    <option value="Single" @if (old('civil_status') == "Single") {{ 'selected' }} @endif>Single</option>
                    <option value="Married" @if (old('civil_status') == "Married") {{ 'selected' }} @endif>Married</option>
                    <option value="Widowed" @if (old('civil_status') == "Widowed") {{ 'selected' }} @endif>Widowed</option>
                    <option value="Divorced" @if (old('civil_status') == "Divorced") {{ 'selected' }} @endif>Divorced</option>
                    <option value="Separated" @if (old('civil_status') == "Separated") {{ 'selected' }} @endif>Separated</option>
                    <option value="Annuled" @if (old('civil_status') == "Annuled") {{ 'selected' }} @endif>Annuled</option>
                    <option value="Live-In" @if (old('civil_status') == "Live-In") {{ 'selected' }} @endif>Live-In</option>
                </select>
                @Error('civil_status')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
              <div class="form-group col-sm-4">
                <select class="form-control item" name="gender" required autocomplete="gender" >
                    <option value="">-Select Gender-</option>
                    <option value="Male"  @if (old('gender') == "Male") {{ 'selected' }} @endif >Male</option>
                    <option value="Female"  @if (old('gender') == "Female") {{ 'selected' }} @endif>Female</option>
                </select>
                @Error('gender')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="form-group col-sm-3">
                  <input type="text" class="form-control item" name="street" id="street" placeholder="Street" value="{{old('street')}}">
                  @Error('street')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>

            <div class="form-group col-sm-3">
                <input type="text" class="form-control item" name="house_no" id="house_no" placeholder="House No" value="{{old('house_no')}}">
                @Error('house_no')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
              <div class="form-group col-sm-3">
                <select class="form-control item" name="voter_status" value="{{old('voter_status')}}" required autocomplete="voter_status" value="{{old('voter_status')}}">
                    <option value="">-Select Voter Status-</option>
                    <option value="Voter" @if (old('voter_status') == "Voter") {{ 'selected' }} @endif>Voter</option>
                    <option value="Non Voter" @if (old('voter_status') == "Non Voter") {{ 'selected' }} @endif>Non Voter</option>
                </select>
                @Error('voter_status')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                @enderror
              </div>

              <div class="form-group col-sm-3">
                  <input type="text" class="form-control item" name="citizenship" id="citizenship" placeholder="Citizenship" value="{{old('citizenship')}}">
                  @Error('citizenship')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>
            </div>

            <div class="row mb-4">
              <div class="form-group col-sm-4">
                <input type="text" class="form-control item" name="phone_number" id="phone_number" placeholder="Contact Number" value="{{old('phone_number')}}">
                @Error('phone_number')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
          </div>

            <div class="form-group col-sm-4">
                <input type="text" class="form-control item" name="occupation" id="occupation" placeholder="Occupation" value="{{old('occupation')}}">
                @Error('occupation')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
              <div class="form-group col-sm-4">
                <select class="form-control item" name="work_status" value="{{old('work_status')}}" required autocomplete="work_status" value="{{old('work_status')}}">
                    <option value="">-Select Work Status-</option>
                    <option value="Employed" @if (old('work_status') == "Employed") {{ 'selected' }} @endif>Employed</option>
                    <option value="Unemployed" @if (old('work_status') == "Unemployed") {{ 'selected' }} @endif>Unemployed</option>
                    <option value="Self-Employed" @if (old('work_status') == "Self-Employed") {{ 'selected' }} @endif>Self Employed</option>
                 </select>
                @Error('work_status')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>
          </div>

          <div class="row mb-4">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control item" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                @Error('email')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
          <div class="form-group col-sm-6">
              <input type="text" class="form-control item" name="username" id="username" placeholder="Username" value="{{old('username')}}">
              @Error('username')
              <p class="text-danger text-md mt-1">{{$message}}</p>
             @enderror
          </div>
              <div class="form-group col-sm-6">
                  <input type="password" class="form-control item" name="password" id="password" placeholder="Password">
                  @Error('password')
                  <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
              </div>
              <div class="form-group col-sm-6">
                <input type="password" class="form-control item" name="password_confirmation" id="password" placeholder="Confirm Password">
                @Error('password_confirmation')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
            </div>
          </div>
                
          <hr class="my-4">
          <div class="row mb-4">
            <div class="col-md-6">
              <div class="form-group">
                <label >Profile Image</label><br>
                <img id="prview"style="width: 150px; height:80px" />
                <input type="file" name="resident_image" id="resident_image">
                @Error('resident_image')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
              </div>
              <div class="form-group">
                <label >Valid ID Image</label><br>
                <img id="prvieww"style="width: 150px; height:80px" />
                <input type="file"  name="id_image" id="id_image">
                @Error('id_image')
                <p class="text-danger text-md mt-1">{{$message}}</p>
               @enderror
              </div>
            </div>
            <div class="col-md-6">
              <p class="mb-2">Reminders!</p>
              <p class="small text-muted mb-2"> You have to Register to create an account, and you have upload an image of your ID to verify if you're truly a residence of the barangay </p>
              <p class="small text-muted mb-2"> NOTE: </p>
              <ul class="small text-muted pl-4 mb-0">
                <li>Your ID's image must be readable and clear to be accepted. </li>
                <li>Upon registration, the barangay official will verify your profile to determine whether you are in really a resident of the barangay.</li>
                <li>If the barangay official verify that you're a residence of the barangay, then you will have an account and you can now login </li>
              </ul>
            </div>
          </div>
          <input type="hidden"  name="userType" value="1">
          <input type="hidden"  name="status" value="0">
            
            <div class="form-group">
              <button type="submit" class="btn btn-block create-account">Register</button>
          </div>
          <p class="mt-2 mb-3 text-center">Already have an account? <a href="/login">Sign Up</p></a>
          <a href="/" class="float-right" style="text-decoration:none"><i class="fas fa-arrow-circle-left " ></i>Back</p></a>
        </form>
       
    </div>

</body>
</html>

<script>
  window.dataLayer = window.dataLayer || [];

  function gtag()
  {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-56159088-1');
</script>

<script type="text/javascript">

$("document").ready(function()

{
  setTimeout(function()
    {
      $("div.alert").remove();
    },3000);
});
</script>

<script>
 $(function() {
    $("#nu_datebirth").datepicker({
    onSelect: function(value, ui) {
        var today = new Date(),
            age = today.getFullYear()- ui.selectedYear;
        $('#a_ge').val(age);
    },   
    dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+0"
    });
      
});
  </script>

{{-- <script>
  $(function() {
     $("#nu_datebirth").datepicker({
     onSelect: function(value, ui) {
         var today = new Date(),
             day = new Date(d),
             month = today.getMonth(),
             year = today.getFullYear() - day.getFullYear();
             m = today.getMonth() - day.getMonth();
             age= today
             $('#a_ge').val(m);
     },
        
     dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+0"
     });
       
 });
   </script> --}}

<script>
  resident_image.onchange = evt => {
    const [file] = resident_image.files
    if (file) {
      prview.style.visibility = 'visible';
  
      prview.src = URL.createObjectURL(file)
    }
  }
</script>

<script>
  id_image.onchange = evt => {
    const [file] = id_image.files
    if (file) {
      prvieww.style.visibility = 'visible';
  
      prvieww.src = URL.createObjectURL(file)
    }
  }
</script>

