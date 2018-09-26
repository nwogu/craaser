<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Craaser">
    <meta name="author" content="Craaser">
    <meta name="keywords" content="Craaser">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="{{ URL::asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ URL::asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ URL::asset('css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            Craaser
                        </div>
                        <div class="login-form">
                            <form action="{{ route('register') }}" method="post">
                            @csrf

                                <div class="form-group">
                                    <label>Company name</label>
                                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} au-input au-input--full" type="text" value="{{ old('name') }}" name="name" placeholder="Company Name">
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Craaser.com/</label>
                                    <input class="form-control{{ $errors->has('company_slug') ? ' is-invalid' : '' }} au-input au-input--full" type="text" value="{{ old('company_slug') }}" name="company_slug" placeholder="Company Slug">
                                    @if ($errors->has('company_slug'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_slug') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} au-input au-input--full" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} au-input au-input--full" type="password" name="password" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input id="password-confirm" class="form-control au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
                                    
                                </div>
                                
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
                                
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="#">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ URL::asset('vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ URL::asset('vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ URL::asset('vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ URL::asset('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ URL::asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ URL::asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ URL::asset('js/main.js') }}"></script>

</body>

</html>
<!-- end document-->