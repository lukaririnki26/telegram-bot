@extends('master.layout')
@section('title', 'Settings Integrations')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">@lang('admin.settings_integration')</h4>
                            <div class="nk-block-des"><p>@lang('admin.settings_integration_description')</p></div>
                        </div><!-- .nk-block-head-content -->
                    </div>
                </div>

                <div class="row g-gs">
                    <div class="col-12">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="d-flex">
                                    <img src="https://storage-circlecreative.sgp1.digitaloceanspaces.com/payfren/454/doku.png?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&amp;X-Amz-Algorithm=AWS4-HMAC-SHA256&amp;X-Amz-Credential=DO00QFFGVQU2M2NG83WJ%2F20241122%2Fsgp1%2Fs3%2Faws4_request&amp;X-Amz-Date=20241122T000626Z&amp;X-Amz-SignedHeaders=host&amp;X-Amz-Expires=3600&amp;X-Amz-Signature=ae9e0e3ae4192735f0d1aef0bdb23383656450cc21b14e3d617923bf34310ae5" alt="DOKU" width="80px" style="object-fit: contain;">
                                    <div class="info ms-3 mt-3">
                                        <h5 class="title">
                                            PayFren
                                        </h5>
                                        <div class="meta">

                                        <span class="author">
                                            <span class="text-soft">
                                                <em class="icon ni ni-user-circle"></em>
                                            </span>
                                            <span>
                                                Circle Creative
                                            </span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="action ms-auto mt-4">
                                        <div class="custom-control custom-switch checked" style="top: 8px;">
                                            <input type="checkbox" class="custom-control-input integration-enable" id="customSwitchPayFren" data-title="PayFren" checked="">
                                            <label class="custom-control-label" for="customSwitchPayFren"></label>
                                        </div>
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Configure">
                                            <em class="icon ni ni-setting"></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
