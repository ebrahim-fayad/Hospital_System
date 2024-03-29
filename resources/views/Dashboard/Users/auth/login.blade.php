@extends('Dashboard.layouts.master2')
@section('title')
    {{ trans('login_trans.home_page') }}
@endsection
@section('css')
    <!-- Sidemenu-respoansive-tabs css -->
    <link href="{{ URL::asset('Dashboard/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css') }}"
        rel="stylesheet">
    <style>
        .panel {
            display: none;
        }
    </style>
@endsection
@section('content')
    @session('error')
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: "error",
                    title: "  Oops...",
                    text: " {{ $value }}",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
        </script>
    @endsession
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
                <div class="row wd-100p mx-auto text-center">
                    <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                        <img src="{{ URL::asset('Dashboard/img/media/login.png') }}"
                            class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                    </div>
                </div>
            </div>
            <!-- The content half -->
            <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
                <div class="login d-flex align-items-center py-2">
                    <!-- Demo content-->
                    <div class="container p-0">
                        <div class="row">
                            <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                                <div class="card-sigin">
                                    <div class="mb-5 d-flex"> <a href="{{ url('/' . ($page = 'index')) }}"><img
                                                src="{{ URL::asset('Dashboard/img/brand/favicon.png') }}"
                                                class="sign-favicon ht-40" alt="logo"></a>
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                    </div>
                                    @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                    <div class="card-sigin">
                                        <div class="main-signup-header">
                                            <h2>{{ trans('login_trans.Welcome') }}</h2>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">
                                                    {{ trans('login_trans.Select_Enter') }}
                                                </label>
                                                <select class="form-control" id="sectionChooser">
                                                    <option value="" selected disabled>
                                                        {{ trans('login_trans.Choose_list') }}
                                                    </option>
                                                    <option value="user">{{ trans('login_trans.user') }}
                                                    </option>
                                                    <option value="admin">{{ trans('login_trans.admin') }}</option>
                                                    <option value="doctor">{{ trans('login_trans.doctor') }}</option>
                                                    <option value="ray_employee"> {{ trans('login_trans.X-ray_employee') }}
                                                    </option>
                                                    <option value="laboratorie_employee">
                                                        {{ trans('login_trans.Laboratory_employee') }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="panel" id="user">
                                                <h5 class="text-primary">{{ trans('login_trans.user') }}</h5>
                                                <form action="{{ route('patients.login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email"
                                                            type="text" name="email">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" name="password"
                                                            type="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-check-input" type="checkbox" name="remember">
                                                        <label class="form-check-label" for="remember-me">
                                                            {{ trans('login_trans.Remember_Me') }}</label>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-main-primary btn-block">{{ trans('login_trans.sign_in') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i class="fab fa-facebook-f"></i>
                                                                Signup with Facebook</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i> Signup with Twitter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">Forgot password?</a></p>
                                                    <p>Donet have an account? <a
                                                            href="{{ url('/' . ($page = 'signup')) }}">Create
                                                            an Account</a></p>
                                                </div>
                                            </div>
                                            {{--  #### Admin panel#####  --}}
                                            <div class="panel" id="admin">
                                                <h5 class="text-primary">{{ trans('login_trans.admin') }} </h5>
                                                <form action="{{ route('admin.login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email"
                                                            type="text" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" name="password"
                                                            type="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="remember">
                                                        <label class="form-check-label" for="remember-me">
                                                            {{ trans('login_trans.Remember_Me') }}</label>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-main-primary btn-block">{{ trans('login_trans.sign_in') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i class="fab fa-facebook-f"></i>
                                                                Signup with Facebook</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i> Signup with Twitter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">Forgot password?</a></p>
                                                    <p>Donet have an account? <a
                                                            href="{{ url('/' . ($page = 'signup')) }}">Create
                                                            an Account</a></p>
                                                </div>
                                            </div>
                                            {{--  #### End Admin panel#####  --}}
                                            {{--  #### Doctor panel#####  --}}
                                            <div class="panel" id="doctor">
                                                <h5 class="text-primary">{{ trans('login_trans.doctor') }} </h5>
                                                <form action="{{ route('doctor.login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email"
                                                            type="text" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" name="password"
                                                            type="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="remember">
                                                        <label class="form-check-label" for="remember-me">
                                                            {{ trans('login_trans.Remember_Me') }}</label>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-main-primary btn-block">{{ trans('login_trans.sign_in') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i
                                                                    class="fab fa-facebook-f"></i>
                                                                Signup with Facebook</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i> Signup with
                                                                Twitter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">Forgot password?</a></p>
                                                    <p>Donet have an account? <a
                                                            href="{{ url('/' . ($page = 'signup')) }}">Create
                                                            an Account</a></p>
                                                </div>
                                            </div>
                                            {{--  #### End Doctor panel#####  --}}
                                            {{--  #### ray_employee panel#####  --}}
                                            <div class="panel" id="ray_employee">
                                                <h5 class="text-primary">{{ trans('login_trans.X-ray_employee') }} </h5>
                                                <form action="{{ route('ray_employee.login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email"
                                                            type="text" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" name="password"
                                                            type="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="remember">
                                                        <label class="form-check-label" for="remember-me">
                                                            {{ trans('login_trans.Remember_Me') }}</label>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-main-primary btn-block">{{ trans('login_trans.sign_in') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i
                                                                    class="fab fa-facebook-f"></i>
                                                                Signup with Facebook</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i> Signup with
                                                                Twitter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">Forgot password?</a></p>
                                                    <p>Donet have an account? <a
                                                            href="{{ url('/' . ($page = 'signup')) }}">Create
                                                            an Account</a></p>
                                                </div>
                                            </div>
                                            {{--  #### End ray_employee panel#####  --}}
                                            {{--  #### ray_employee panel#####  --}}
                                            <div class="panel" id="laboratorie_employee">
                                                <h5 class="text-primary">{{ trans('login_trans.X-ray_employee') }} </h5>
                                                <form action="{{ route('laboratory_employee.login') }}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input class="form-control" placeholder="Enter your email"
                                                            type="text" name="email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label> <input class="form-control"
                                                            placeholder="Enter your password" name="password"
                                                            type="password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="remember">
                                                        <label class="form-check-label" for="remember-me">
                                                            {{ trans('login_trans.Remember_Me') }}</label>
                                                    </div>
                                                    <button type="submit"
                                                        class="btn btn-main-primary btn-block">{{ trans('login_trans.sign_in') }}</button>
                                                    <div class="row row-xs">
                                                        <div class="col-sm-6">
                                                            <button class="btn btn-block"><i
                                                                    class="fab fa-facebook-f"></i>
                                                                Signup with Facebook</button>
                                                        </div>
                                                        <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                            <button class="btn btn-info btn-block"><i
                                                                    class="fab fa-twitter"></i> Signup with
                                                                Twitter</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="main-signin-footer mt-5">
                                                    <p><a href="">Forgot password?</a></p>
                                                    <p>Donet have an account? <a
                                                            href="{{ url('/' . ($page = 'signup')) }}">Create
                                                            an Account</a></p>
                                                </div>
                                            </div>
                                            {{--  #### End ray_employee panel#####  --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End -->
                </div>
            </div><!-- End -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#sectionChooser').change(function() {
            var myId = $(this).val();
            $('.panel').each(function() {
                myId == $(this).attr('id') ? $(this).show() : $(this).hide();
            })
        });
    </script>
@endsection
