@extends('master.layout')
@section('title', 'Bot')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">@lang('admin.bot')</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control input-filter" data-target="botTable" id="search-input" placeholder="Quick search by name, description">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="botForm" data-form-title="Add New Bot" class="btn-form-reset toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="botForm" data-form-title="Add New Bot" class="btn-form-reset toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Bot</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                @if($bots->isNotEmpty())
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div id="botTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="table-select-all">
                                                <label class="custom-control-label" for="table-select-all"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>User</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                        <div class="nk-tb-col"><span>Username</span></div>
                                        <div class="nk-tb-col"><span>Token</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools"></div>
                                    </div>
                                    @foreach ($bots as $bot)
                                        <div class="nk-tb-item table-row-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="bot-{{ $bot->id }}" data-id="{{ $bot->id }}">
                                                    <label class="custom-control-label" for="bot-{{ $bot->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <div class="tb-product">
                                                    <div class="title">{{ $bot->user?->name }}</div>
                                                </div>
                                                <div class="tb-sub">{{ $bot->user?->email }}</div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $bot->name }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $bot?->username }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $bot?->token }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="{{ route('settings.bots.setting.form', [ 'bot' => $bot->id ]) }}"><em class="icon ni ni-setting"></em><span>Setting</span></a></li>
                                                                    <li><a href="{{ route('settings.bots.menus.index', [ 'bot' => $bot->id ]) }}"><em class="icon ni ni-setting"></em><span>Manage Menu</span></a></li>
                                                                    <li><a href="{{ route('settings.bots.states.index', [ 'bot' => $bot->id ]) }}"><em class="icon ni ni-setting"></em><span>Manage State</span></a></li>
                                                                    <li><a href="javascript:void(0)" data-target="botForm" data-url="{{ route('settings.bots.show', [ 'id' => $bot->id ]) }}" data-form-title="Edit Bot" class="toggle btn-action-sidebar-edit"><em class="icon ni ni-edit"></em><span>Update Bot</span></a></li>
                                                                    <li><a href="javascript:void(0)" class="btn-action-delete" data-url="{{ route('settings.bots.delete', [ 'id' => $bot->id ]) }}" data-label="{{ $bot->name }}"><em class="icon ni ni-trash"></em><span>Remove Bot</span></a></li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                        {{ $bots->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $bots->links('components.pagination-goto') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
                @else
                <center>
                    No Data
                </center>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('form')
    <div id="botFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="botForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Bot Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('settings.bots.store') }}" id="botForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="product-user">User</label>
                            <div class="form-control-wrap">
                                <select class="form-control select2" id="bot-user" name="user_id" key="user">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="bot-name">Name</label>
                            <div class="form-control-wrap">
                                <input type="hidden" id="bot-id" name="id" key="id">
                                <input type="text" class="form-control" id="bot-name" name="name" key="name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="bot-username">Username</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="bot-username" name="username" key="username">
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
@endpush

@push('scripts')
<x-jqueryTable :tableId="'botTable'"></x-jqueryTable>
<x-jqueryForm :formId="'botForm'"></x-jqueryForm>
<script>
    $("#bot-user").select2({
        ajax: {
            url: "{{route('settings.users.index')}}",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (response, params) {
                params.page = params.page || 1;

                return {
                    results: response.data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.email
                        };
                    }),
                };
            },
            cache: true
        },
        placeholder: "Pilih User...",
        minimumInputLength: 1
    });
</script>
@endpush
