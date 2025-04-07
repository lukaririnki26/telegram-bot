<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg"
    data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: auto; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <div class="card-inner">
                                <div class="user-card">
                                    <div class="user-avatar bg-primary">
                                        <img src="{{ $user->avatar }}" class="rounded-circle" alt="Avatar" width="50" height="50">
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{$user->name}}</span>
                                        <span class="sub-text">{{$user->email}}</span></div>
                                    <div class="user-action">
                                        <div class="dropdown"><a class="btn btn-icon btn-trigger me-n2"
                                                data-bs-toggle="dropdown" href="#" aria-expanded="false"><em
                                                    class="icon ni ni-more-v"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end" style="">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="javascript:void(0)" class="btn-form-reset toggle" data-target="avatarForm">
                                                            <em class="icon ni ni-camera-fill"></em>
                                                            <span>Change Avatar</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner p-0">
                                <ul class="link-list-menu">
                                    <li>
                                        <a @class(['active' => request()->routeIs('profile.index')]) href="{{route('profile.index')}}">
                                        <em class="icon ni ni-user-fill-c"></em>
                                        <span>Personal Infomation</span>
                                        </a>
                                    </li>
                                    <li><a href="/demo1/user-profile-notification.html"><em
                                                class="icon ni ni-bell-fill"></em><span>Notifications</span></a>
                                    </li>
                                    <li><a @class(['active' => request()->routeIs('profile.security-settings.index')]) href="{{route('profile.security-settings.index')}}"><em
                                                class="icon ni ni-lock-alt-fill"></em><span>Security
                                                Settings</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: 299px; height: 504px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
        </div>
    </div>
</div>

@push('form')
<div id="avatarFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="avatarForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 data-content="form-title" class="nk-block-title">Avatar Form</h5>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <form data-url="{{ route('profile.change-avatar') }}" id="avatarForm">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="product-title">@lang('admin.avatar')</label>
                        <div class="form-control-wrap">
                            <div class="form-control-wrap">
                                <input type="file" class="" id="input-file" name="avatar"
                                    data-default-file="{{$user->avatar}}">
                            </div>
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
<x-jqueryForm :formId="'avatarForm'"></x-jqueryForm>
<script src="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
    </style>
@endpush

