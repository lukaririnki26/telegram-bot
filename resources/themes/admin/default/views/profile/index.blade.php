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
                                                <h4 class="nk-block-title">Personal Information</h4>
                                                <div class="nk-block-des">
                                                    <p>Basic info, like your name and address, that you use on Nio Platform.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none"><a href="#"
                                                    class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Basics</h6>
                                            </div>
                                            <div class="data-item toggle" data-target="profileForm">
                                                <div class="data-col"><span class="data-label">Full Name</span><span
                                                        class="data-value">{{$user->name}}</span></div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col"><span class="data-label">Email</span><span
                                                        class="data-value">{{$user->email}}</span></div>
                                                <div class="data-col data-col-end"><span class="data-more disable"><em
                                                            class="icon ni ni-lock-alt"></em></span></div>
                                            </div>
                                            <div class="data-item toggle" data-target="profileForm">
                                                <div class="data-col"><span class="data-label">MSISDN</span><span
                                                        class="data-value text-soft">{{$user->msisdn}}</span></div>
                                                <div class="data-col data-col-end"><span class="data-more"><em
                                                            class="icon ni ni-forward-ios"></em></span></div>
                                            </div>
                                        </div>
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Preferences</h6>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col"><span class="data-label">Language</span><span
                                                        class="data-value">{{$user->language}}</span></div>
                                                <div class="data-col data-col-end"><a href="javascript:void(0)"
                                                        class="link link-primary toggle" data-target="languageForm">Change Language</a></div>
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
    <div id="profileFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="profileForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Profile Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('profile.store') }}" id="profileForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="product-title">@lang('admin.name')</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control input-name" data-target="profile-name" id="profile-name" name="name" key="name" value="{{$user->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="regular-price">@lang('admin.msisdn')</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="profile-msisdn" name="msisdn" key="msisdn" value="{{$user->msisdn}}">
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

    <div id="languageFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="languageForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Profile Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('profile.change-language') }}" id="languageForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="product-title">@lang('admin.language')</label>
                            <div class="form-control-wrap">
                                <select name="language" id="language" class="form-control" key="language">
                                    <option value="en" @selected($user->language == 'en')>English</option>
                                    <option value="id" @selected($user->language == 'id')>Indonesia</option>
                                </select>
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
<x-jqueryForm :formId="'profileForm'"></x-jqueryForm>
<x-jqueryForm :formId="'languageForm'"></x-jqueryForm>
@endpush
