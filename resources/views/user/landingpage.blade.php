@include('partials.header')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <a href="index.html" class="logo me-auto">
        @foreach($setting as $settings)
        <img src="{{$settings->barangay_logo ? asset ('storage/' .$settings->barangay_logo) : asset('/storage/no/-image.png')}}" class="img-fluid">
        @endforeach
      </a>
      {{-- <h1 class="logo me-auto"><a href="index.html">WBMS | Paloyon Oriental</a></h1> --}}
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto fw-bold" href="#hero" style="padding: 10px;">Home</a></li>
          <li><a class="nav-link scrollto fw-bold" href="#about" style="padding: 10px;">About</a></li>
          <li><a class="nav-link scrollto fw-bold" href="#services" style="padding: 10px;">Services</a></li>
          {{-- <li><a class="nav-link scrollto fw-bold" href="#portfolio" style="padding: 10px;">Portfolio</a></li> --}}
          <li><a class="nav-link scrollto fw-bold" href="#team" style="padding: 10px;">Officials</a></li>
          <li><a class="nav-link scrollto fw-bold" href="#contact" style="padding: 10px;">Contact </a></li>
          <li><a class="getstarted scrollto fw-bold" href="/login" style="padding: 10px;">Login/Register <i class="fa fa-sign-in" aria-hidden="true"></i></a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    @foreach ($setting as $settings)
        <div class="container">
          @if(session()->has('message'))
          <div class="alert alert-primary" id="alert">
          <button type="button" class="close" data-dismiss="alert">x</button>
          {{session()->get('message')}}
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Welcome to Baranga{{$settings->barangay_name}}!</h1>
                <h3>{{$settings->system_title}}</h3>
                <h4>
                    {{$settings->brgy_location}}<br />
                    Open Hours of Barangay: Monday to Friday (8AM - 5PM)
                </h4>
                <h4>
                    <div id="pst-container" style="color: rgba(253, 228, 0, 0.993);">
                        <div>Philippine Standard Time:</div>
                        <div id="pst-time"></div>
                   </div>
                </h4>
              <div class="d-flex justify-content-center justify-content-lg-start">
                <a href="#about" class="btn-get-started scrollto">About Us</a>
                {{-- <a href="https://www.youtube.com/watch?v=Xv1eBqZALqw" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
              </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
              <img class="img-fluid animated" id="preview" src="{{$settings->system_logo ? asset ('storage/' .$settings->system_logo) : asset('/storage/no/-image.png')}}" style="width:700px; height:400px" />
            </div>
          </div>
        </div>

      </section><!-- End Hero -->
      @endforeach
      <main id="main">

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
          <div class="container">

            <div class="row counters position-relative">

              <div class="col-lg-3 col-6 text-center">
                <span>{{ $house_no ?? '0'}}</span>
                <p>Household</p>
              </div>

              <div class="col-lg-3 col-6 text-center">
                <span>{{ $residents ?? '0'}}</span>
                <p>Population</p>
              </div>

              <div class="col-lg-3 col-6 text-center">
                <span>{{ $male ?? '0'}}</span>
                <p>Male</p>
              </div>

              <div class="col-lg-3 col-6 text-center">
                <span>{{ $female ?? '0'}}</span>
                <p>Female</p>
              </div>


            </div>

          </div>
        </section><!-- End Counts Section -->


        <!-- ======= About Us Section ======= -->

        <section id="about" class="about">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>About Us</h2>
            </div>
           @foreach ($setting as $settings)
            <div class="row content">
              <div class="col-lg-6">
                <p>
                    {{$settings->about_section1}}
                </p>

              </div>
              <div class="col-lg-6 pt-4 pt-lg-0">
                <p>
                  {{$settings->about_section2}}
                </p>
                <a href="#" class="btn-learn-more">Learn More</a>
              </div>
            </div>
     @endforeach
          </div>
        </section><!-- End About Us Section -->
        @foreach ($setting as $settings)
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us section-bg">
          <div class="container-fluid" data-aos="fade-up">

            <div class="row">

              <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

                <div class="content">
                  <h3><strong>Vision, Mission & Goals</strong></h3>
                  <p>
                   {{$settings->description}}
                  </p>
                </div>

                <div class="accordion-list">
                  <ul>
                    <li>
                      <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Vision<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                      <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                        <p>
                          {{$settings->vission}}
                        </p>
                      </div>
                    </li>

                    <li>
                      <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Mission <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                      <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                        <p>
                          {{$settings->mission}}
                        </p>
                      </div>
                    </li>

                    <li>
                      <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Goals<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                      <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                        <p>
                          {{$settings->goal}}
                        </p>
                      </div>
                    </li>

                  </ul>
                </div>

              </div>

              <img class="col-lg-5 align-items-stretch order-1 order-lg-2 img"id="preview" src="{{$settings->barangay_logo ? asset ('storage/' .$settings->barangay_logo) : asset('/storage/no/-image.png')}}"  style="width:550px; height:550px" />
            </div>

          </div>
        </section><!-- End Why Us Section -->
        @endforeach

        <!-- ======= Skills Section ======= -->


           <!-- ======= Services Section ======= -->
           <section id="services" class="services">
            <div class="container" data-aos="fade-up">

              <div class="section-title">
                <h2>Services</h2>
                <p style="font-size: 15px;">Paloyon Oriental provides document processing services such as barangay clearance, barangay indigency, barangay residency and also report a blotter. The resident must be a registered resident of the barangay in order for the request to be processed; otherwise, the request will be denied.</p>
              </div>

              <div class="row">

                <div class="col-xl-3 col-md-12 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                  <div class="icon-box">
                    <div class="icon"><i class="bx bx-certification"></i></div>
                    <h6>CERTIFICATE OF CLEARANCE</h6>
                    <p>This is a certificate of good moral character issued by the barangay needed for many important business, job, or personal transactions.</p>
                    <a href="/request"><button class="b1">Request</button></a>
                  </div>
                </div>

                <div class="col-xl-3 col-md-12 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                      <div class="icon"><i class="bx bx-group"></i></div>
                      <h6>CERTIFICATE OF INDIGENCY</h6>
                      <p>This certificate is issued to less fortunate resident who desires to avail assistance such as Scholarship, Medical Services, and the like.</p>
                      <a href="/request2"><button class="b1">Request</button></a>
                    </div>
                  </div>

                  <div class="col-xl-3 col-md-12 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon-box">
                      <div class="icon"><i class="bx bx-home"></i></div>
                      <h6>CERTIFICATE OF RESIDENCY</h6>
                      <p>This certificate depends on the purpose of the resident. It may be to certify his/her residency or good standing in the community etc.</p>
                      <a href="/request3"><button class="b1">Request</button></a>
                    </div>
                  </div>

                <div class="col-xl-3 col-md-12 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                  <div class="icon-box">
                    <div class="icon"><i class="bx bx-user-x"></i></div>
                    <h6>REPORT A BLOTTER</h6>
                    <p>If you are a victim of crime, you must secure a barangay blotter, police blotter or report so that you may use them as evidences.</p>
                    <a href="{{url('/residentBlotter')}}"><button class="b1">Report</button></a>
                  </div>
                </div>
                {{--  --}}

               {{--  --}}
              </div>

            </div>
          </section>
                <!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
          <div class="container" data-aos="zoom-in">

            <div class="row">
              <div class="col-lg-9 text-center text-lg-start">
                <h3>Call To Action</h3>
                <p>
                    We are inviting you to join in our organization to help people in needs. To express and extend your help you may contact us in inquiry section or you can directly email us here paloyonoriental@gmail.com
                </p>
              </div>
              <div class="col-lg-3 cta-btn-container text-center">
                <a class="cta-btn align-middle" href="#contact">Call To Action</a>
              </div>
            </div>

          </div>
        </section><!-- End Cta Section -->

        <!-- ======= Portfolio Section ======= -->
       

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
          <div class="container" data-aos="fade-up">

            <div class="section-title">
              <h2>Barangay Officials</h2>
              <p></p>
            </div>

            <div class="row">

            @foreach($official as $officials)
              <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member">
                  <div class="member-img">
                    <img src="{{$officials->official_image ? asset ('storage/' .$officials->official_image) : asset('/storage/no/-image.png')}}" class="img-fluid" style="width:260px; height:260px">
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>{{$officials->name}}</h4>
                    <span>{{$officials->position}}</span>
                  </div>
                </div>
              </div>
            @endforeach
            </div>

          </div>
        </section><!-- End Team Section -->

        
        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
          <div class="container-fluid" data-aos="fade-up">
            
            <div class="section-title">
              <h2>FREQUENTLY ASKED QUESTIONS</h2>
        @foreach ($freq_asked_title as $freq_asked_titles)
              <p class="two">{{$freq_asked_titles->frq_asked_title}}</p>
        @endforeach
            </div>


            <div class="faq-list">
              <ul>
                @foreach ($freq_asked as $freq_askeds)
                <li data-aos="fade-up" data-aos-delay="100">
                  <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">{{$freq_askeds->question}}<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                    <p>
                      {{$freq_askeds->answer}}
                    </p>
                  </div>
                </li>
                @endforeach

              </ul>
            </div>

          </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
          <div class="container" data-aos="fade-up">

            <div class="section-title">

              <h2>Inquiries</h2>
              <p>If you have a questions and inquiries about us and in the barangay you can send us a message here.</p>
            </div>

            <div class="row">
              @foreach ($setting as $settings)
              <div class="col-lg-5 d-flex align-items-stretch">
                <div class="info">
                  <div class="address">
                    <i class="bi bi-geo-alt"></i>
                    <h4>Location:</h4>
                    <p>{{$settings->brgy_location}}</p>
                  </div>

                  <div class="email">
                    <i class="bi bi-envelope"></i>
                    <h4>Email:</h4>
                    <p>{{$settings->brgy_email}}</p>
                  </div>

                  <div class="phone">
                    <i class="bi bi-phone"></i>
                    <h4>Call:</h4>
                    <p>+63 9091389911</p>
                  </div>

                  <iframe src="https://mapcarta.com/36015612/Map" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>

                </div>
                @endforeach
              </div>

              <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="/addInquiries" method="post"  class="email-form">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="name">Your Name</label>
                      <input type="text" name="name" class="form-control" id="name" required>
                      @Error('name')
                      <p class="text-danger text-md mt-1">{{$message}}</p>
                   @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <label for="name">Your Phone Number</label>
                      <input type="text" class="form-control" name="phone_number" id="phone_number" required>
                      @Error('phone_number')
                      <p class="text-danger text-md mt-1">{{$message}}</p>
                   @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="name">Subject</label>
                    <input type="text" class="form-control" name="subject" id="subject" required>
                    @Error('subject')
                    <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Message</label>
                    <textarea class="form-control" name="message" rows="10" required></textarea>
                    @Error('message')
                    <p class="text-danger text-md mt-1">{{$message}}</p>
                 @enderror
                  </div>

                  <div class="text-center"><input type="submit" class="btn btn-success button" value="Send Message">
                </form>
              </div>

            </div>

          </div>
        </section><!-- End Contact Section -->

      </main><!-- End #main -->

      <script src="{{url('assets/js/jquery-3.6.0.min.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

      <script type="text/javascript" id="gwt-pst">
        (function(d, eId) {
            var js, gjs = d.getElementById(eId);
            js = d.createElement('script'); js.id = 'gwt-pst-jsdk';
            js.src = "//gwhs.i.gov.ph/pst/gwtpst.js?"+new Date().getTime();
            gjs.parentNode.insertBefore(js, gjs);
        }(document, 'gwt-pst'));

        var gwtpstReady = function(){
            var firstPst = new gwtpstTime('pst-time');
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#my_summernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
      </script>

    <script>
        $(document).ready(function() {
            $("#dis_summernote").summernote(); //disable
            $('.dropdown-toggle').dropdown();
        });
      </script>

    <script>
        $(document).ready(function() {
            $("#diss_summernote").summernote({airMode:true}).next().find(".note-editable").attr("contenteditable",false); //not to
            $('.dropdown-toggle').dropdown();
        });
      </script>
                  <script type="text/javascript">

                    $("document").ready(function()

                    {
                      setTimeout(function()
                        {
                          $("div.alert").remove();
                        },5000);
                    });
                    </script>

    @include('partials.footer')




