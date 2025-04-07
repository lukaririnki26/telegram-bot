@extends('master.auth')
@section('title', 'Admin Forgot Password')

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
                                    <h5 class="nk-block-title">Reset password</h5>
                                    <div class="nk-block-des">
                                        <p>If you forgot your password, well, then we’ll email you instructions to reset your password.</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('auth.forgot-password-submit') }}">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="default-01">Email</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Send Reset Link</button>
                                </div>
                            </form>
                            <div class="form-note-s2 text-center pt-4">
                                <a href="{{ route('auth.login') }}"><strong>Return to login</strong></a>
                            </div>
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
