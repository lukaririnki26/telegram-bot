@extends('master.layout')
@section('title', 'Bot Menu')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                             <h3 class="nk-block-title page-title">@lang('admin.menu')</h3> {{$bot->name}} {{'@'.$bot->username}}
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
                                                <input type="text" class="form-control input-filter" data-target="menuTable" id="search-input" placeholder="Quick search by name, description">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="menuForm" data-form-title="Add New Bot Menu" class="btn-form-reset toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="menuForm" data-form-title="Add New Bot Menu" class="btn-form-reset toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Bot Menu</span></a>
                                        </li>
                                   </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                @if($menus->isNotEmpty())
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div id="menuTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="table-select-all">
                                                <label class="custom-control-label" for="table-select-all"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Command</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Response</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools"></div>
                                    </div>
                                    @foreach ($menus as $menu)
                                        <div class="nk-tb-item table-row-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="menu-{{ $menu->id }}" data-id="{{ $menu->id }}">
                                                    <label class="custom-control-label" for="menu-{{ $menu->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $menu->command }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $menu->response }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="javascript:void(0)" data-target="menuForm" data-url="{{ route('settings.bots.menus.show', ['bot' => $bot->id, 'id' => $menu->id ]) }}" data-form-title="Edit Bot Menu" class="toggle btn-action-sidebar-edit"><em class="icon ni ni-edit"></em><span>Update Bot Menu</span></a></li>
                                                                    <li><a href="javascript:void(0)" class="btn-action-delete" data-url="{{ route('settings.bots.menus.delete', ['bot' => $bot->id, 'id' => $menu->id ]) }}" data-label="{{ $menu->name }}"><em class="icon ni ni-trash"></em><span>Remove Bot Menu</span></a></li>

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
                                        {{ $menus->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $menus->links('components.pagination-goto') }}
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
    <div id="menuFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="menuForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Bot Menu Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('settings.bots.menus.store',['bot' => $bot->id,]) }}" id="menuForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="menu-name">Command</label>
                            <div class="form-control-wrap">
                                <input type="hidden" id="menu-id" name="id" key="id">
                                <input type="hidden" id="menu-bot-id" name="bot_id" value="{{$bot->id}}">
                                <input type="text" class="form-control" id="menu-command" name="command" key="command">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="menu-response">Response</label>
                            <div class="form-control-wrap">
                                <textarea type="text" class="form-control" id="menu-response" name="response" key="response"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="menu-guard">Guard</label>
                            <div class="form-control-wrap">
                            <ul class="custom-control-group g-3 align-center" key="guard">
                                <li>
                                    <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="guard" id="guard-guest" value="guest">
                                    <label class="custom-control-label" for="guard-guest">Guest</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="guard" id="guard-auth" value="auth">
                                    <label class="custom-control-label" for="guard-auth">Auth</label>
                                    </div>
                                </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="menu-next-state">Next State</label>
                            <div class="form-control-wrap">
                                <select class="form-control select2" id="menu-next-state" name="next_state_id" key="next_state">
                                </select>
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
<x-jqueryTable :tableId="'menuTable'"></x-jqueryTable>
<x-jqueryForm :formId="'menuForm'"></x-jqueryForm>
<script>
    $("#menu-next-state").select2({
        ajax: {
            url: "{{ route('settings.bots.states.index', ['bot' => $bot->id,]) }}",
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
                            text: item.name
                        };
                    }),
                };
            },
            cache: true
        },
        placeholder: "Pilih State...",
        minimumInputLength: 1
    });
</script>
@endpush
