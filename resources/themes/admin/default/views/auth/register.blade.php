@extends('master.auth')
@section('title', 'Admin Register')

@section('content')
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body wide-xs">
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
                                    <h4 class="nk-block-title">Register</h4>
                                    <div class="nk-block-des">
                                        <p>Create New Dashlite Account</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('auth.register-submit') }}">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="name" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email or Username</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg" id="email" placeholder="Enter your email address or username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password">Passcode</label>
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-control-xs custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox">
                                        <label class="custom-control-label" for="checkbox">I agree to Telebots <a href="html/pages/terms-policy.html">Privacy Policy</a> &amp; <a href="html/pages/terms-policy.html"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block">Register</button>
                                </div>
                            </form>
                            <div class="form-note-s2 text-center pt-4"> Already have an account? <a href="{{ route('auth.login') }}"><strong>Sign in instead</strong></a>
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
