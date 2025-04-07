@extends('master.layout')
@section('title', 'Bot Setting')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div id="settingFormContainer" class="nk-add-product">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 data-content="form-title" class="nk-block-title">{{$bot->name}} Setting</h5>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <form data-url="{{ route('settings.bots.setting.store', ['bot' => $bot->id]) }}" id="settingForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="setting-welcome-text">Welcome Text</label>
                                        <div class="form-control-wrap">
                                            <textarea type="text" class="form-control" id="setting-welcome-text" name="welcome_text" key="welcome_text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label" for="setting-unactive-text">Unactive Text</label>
                                        <div class="form-control-wrap">
                                            <textarea type="text" class="form-control" id="setting-unactive-text" name="unactive_text" key="unactive_text"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="bot-token">Token</label>
                                        <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="bot-token" name="token" key="token">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary btn-form-submit" type="submit"><em class="icon ni ni-plus"></em><span>Save</span></button>
                                </div>
                            </div>
                        </form>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<x-jqueryForm :formId="'settingForm'"></x-jqueryForm>
@endpush
