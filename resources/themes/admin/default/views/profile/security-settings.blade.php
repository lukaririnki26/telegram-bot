@extends('master.layout')
@section('title', 'Profile')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Security Settings</h4>
                                                <div class="nk-block-des">
                                                    <p>These settings are helps you keep your account secure.</p>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none"><a href="#"
                                                    class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="card card-bordered">
                                            <div class="card-inner-group">
                                                <div class="card-inner">
                                                    <div class="between-center flex-wrap g-3">
                                                        <div class="nk-block-text">
                                                            <h6>Change Password</h6>
                                                            <p>Set a unique password to protect your account.</p>
                                                        </div>
                                                        <div class="nk-block-actions flex-shrink-sm-0">
                                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                                <li class="order-md-last">
                                                                    <a href="javascript:void(0)" class="btn btn-primary toggle" data-target="passwordForm">Change Password</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('profile.sidebar')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('form')
    <div id="passwordFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="passwordForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Profile Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('profile.security-settings.store') }}" id="passwordForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="product-title">@lang('admin.current_password')</label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control input-current_password" data-target="password-current_password" id="password-current_password" name="current_password" key="current_password">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="regular-price">@lang('admin.new_password')</label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control" id="password-new_password" name="new_password" key="new_password">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="regular-price">@lang('admin.new_password_confirmation')</label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control" id="password-new_password_confirmation" name="new_password_confirmation" key="new_password_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary btn-form-submit" type="submit"><em class="icon ni ni-plus"></em><span>@lang('admin.save')</span></button>
                    </div>
                </div>
            </form>
        </div><!-- .nk-block -->
    </div>
@endpush

@push('scripts')
<x-jqueryForm :formId="'passwordForm'"></x-jqueryForm>
@endpush
