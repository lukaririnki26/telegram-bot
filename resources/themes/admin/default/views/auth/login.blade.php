@extends('master.auth')
@section('title', 'Admin Login')

@section('content')
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                    <div class="brand-logo pb-4 text-center">
                        <a href="" class="logo-link">
                            <img class="logo-light logo-img" src="/themes/admin/default/assets/images/logo.png" srcset="/themes/admin/default/assets/images/logo.png 2x" alt="logo">
                            <img class="logo-dark logo-img" src="/themes/admin/default/assets/images/logo.png" srcset="./themes/admin/default/assets/images/logo.png 2x" alt="logo-dark">
                            <span>
                                Telebot
                            </span>
                        </a>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Login</h4>
                                    <div class="nk-block-des">
                                        <p>Access the Telebot panel using your email and passwrod.</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('auth.login-submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Password</label>
                                        <a class="link link-primary link-sm" href="{{ route('auth.forgot-password') }}">Forgot Password?</a>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="nk-footer nk-auth-footer-full">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="col-lg-6 order-lg-last">
                                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                    <li class="nav-item">
                                        <a class="link link-primary fw-normal py-2 px-3" href="#">Terms & Condition</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="link link-primary fw-normal py-2 px-3" href="#">Privacy Policy</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="link link-primary fw-normal py-2 px-3" href="#">Help</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <div class="nk-block-content text-center text-lg-left">
                                    <p class="text-soft">&copy; 2024 Telebots. All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
@endsection
