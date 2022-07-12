@extends('layouts.master-without-nav')

@section('title')
@lang('translation.Login')
@endsection

@section('css')
<!-- owl.carousel css -->
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.css') }}">
@endsection

@section('body')

<body class="auth-body-bg">
    @endsection

    @section('content')

    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column justify-content-center">

                                <div class="p-4">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">

                                                <div dir="ltr">
                                                    <h2 class="mb-3 text-primary">Welcome to</h2>
                                                    <h2 class="mb-3 text-dark">FUEGO</h2>
                                                    <h2 class="mb-3 text-dark">Health Systems</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="index" class="d-block auth-logo">
                                        {{-- <img src="{{ URL::asset('/assets/images/logo-dark.png') }}" alt="" height="18" class="auth-logo-dark">
                                        <img src="{{ URL::asset('/assets/images/logo-light.png') }}" alt="" height="18" class="auth-logo-light"> --}}
                                        <h1>FEUGO</h1>
                                    </a>
                                </div>
                                <div class="my-auto">
                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Sign in to continue to Feugo.</p>
                                    </div>
                                    {{-- @isset($url)
                                            <form method="POST" action='{{ url('/'.$url) }}'
                                    aria-label="{{ __('Login') }}">

                                    @else --}}
                                    <div class="mt-4">
                                        <form class="form-horizontal" method="POST" action="{{ route('login_user') }}">
                                            {{-- @endisset --}}
                                            @csrf
                                            {{-- <div class="mb-3">
                                                <label for="username" class="form-label">Employee ID</label>
                                                <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="username" placeholder="Enter Employee ID" autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label">User ID<span style="color:red">*</span></label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" name="username" placeholder="Enter User ID">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="float-end">
                                            @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                            @endif
                                        </div>
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                            <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="userpassword" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>
                                    </form>
                                    <div class="mt-5 text-center">
                                        <p>Employee Account ? <a href="{{ route('employee.login') }}" class="fw-medium text-primary"> Login </a> </p>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <p>Don't have an account ? <a href="{{ url('register') }}" class="fw-medium text-primary"> Signup now </a> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
    </div>

    @endsection
    @section('script')
    <!-- owl.carousel js -->
    <script src="{{ URL::asset('/assets/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <!-- auth-2-carousel init -->
    <script src="{{ URL::asset('/assets/js/pages/auth-2-carousel.init.js') }}"></script>
    @endsection
