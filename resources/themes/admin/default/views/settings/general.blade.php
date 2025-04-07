@extends('master.layout')
@section('title', 'Settings General')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">@lang('admin.settings_general')</h4>
                            <div class="nk-block-des"><p>@lang('admin.settings_general_description')</p></div>
                        </div><!-- .nk-block-head-content -->
                    </div>
                </div>

                <div class="card card-bordered">
                    <div class="card-inner">
                        <form action="{{ route('settings.general.store') }}" method="post" enctype="multipart/form-data" class="gy-3">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="site-off">@lang('admin.maintenance_mode')</label>
                                        <span class="form-note">@lang('admin.maintenance_mode_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="maintenance_mode" id="maintenance-mode" {{ isset($general_settings['mainenance_mode']) && $general_settings['mainenance_mode'] == true ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="maintenance-mode">@lang('admin.offline')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="site-name">@lang('admin.site_name')</label>
                                        <span class="form-note">@lang('admin.site_name_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="site-name" name="site_name" value="{{ $general_settings['site_name'] ?? null }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.site_email')</label>
                                        <span class="form-note">@lang('admin.site_email_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="site-email" name="site_email" value="{{ $general_settings['site_email'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.site_phone')</label>
                                        <span class="form-note">@lang('admin.site_phone_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="site-phone" name="site_phone" value="{{ $general_settings['site_phone'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.line_username')</label>
                                        <span class="form-note">@lang('admin.line_username_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="line-username-addon"><em class="icon ni ni-line"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="line-username" name="line_username" value="{{ $general_settings['line_username'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.wechat_username')</label>
                                        <span class="form-note">@lang('admin.wechat_username_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="wechat-username-addon"><em class="icon ni ni-wechat"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="wechat-username" name="wechat_username" value="{{ $general_settings['wechat_username'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.whatsapp_username')</label>
                                        <span class="form-note">@lang('admin.whatsapp_username_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="whatsapp-username-addon"><em class="icon ni ni-whatsapp"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="whatsapp-username" name="whatsapp_username" value="{{ $general_settings['whatsapp_username'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.linkedin_url')</label>
                                        <span class="form-note">@lang('admin.linkedin_url_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="linkedin-url-addon"><em class="icon ni ni-linkedin"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="linkedin-url" placeholder="https://linkedin.com/company/username" name="linkedin_url" value="{{ $general_settings['linkedin_url'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.facebook_url')</label>
                                        <span class="form-note">@lang('admin.facebook_url_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="facebook-url-addon"><em class="icon ni ni-facebook-f"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="facebook-url" placeholder="https://facebook.com/username" name="facebook_url" value="{{ $general_settings['facebook_url'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.instagram_url')</label>
                                        <span class="form-note">@lang('admin.instagram_url_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="instagram-url-addon"><em class="icon ni ni-instagram"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="instagram-url" placeholder="https://instagram.com/username" name="instagram_url" value="{{ $general_settings['instagram_url'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.twitter_url')</label>
                                        <span class="form-note">@lang('admin.twitter_url_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="twitter-url-addon"><em class="icon ni ni-twitter"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="twitter-url" placeholder="https://twitter.com/username" name="twitter_url" value="{{ $general_settings['twitter_url'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.tiktok_url')</label>
                                        <span class="form-note">@lang('admin.tiktok_url_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="tiktok-url-addon"><em class="icon ni ni-tiktok"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="tiktok-url" placeholder="https://tiktok.com/username" name="tiktok_url" value="{{ $general_settings['tiktok_url'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.site_address')</label>
                                        <span class="form-note">@lang('admin.site_address_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <textarea class="form-control no-resize" id="site-address" name="site_address">{{ $general_settings['site_address'] ?? null  }}</textarea>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group"><label class="form-label">@lang('admin.google_map_url')</label>
                                        <span class="form-note">@lang('admin.google_map_url_help')</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="google-map-url-addon"><em class="icon ni ni-map-pin"></em></span>
                                            </div>
                                            <input type="text" class="form-control" id="google-map-url" placeholder="https://maps.google.com/" name="google_map_url" value="{{ $general_settings['google_map_url'] ?? null  }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row g-3">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary">@lang('admin.save')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
