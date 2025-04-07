@extends('master.layout')
@section('title', 'Bot State')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">@lang('admin.state')</h3> {{$bot->name}} {{'@'.$bot->username}}
                        </div>
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageState"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageState">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control input-filter" data-target="stateTable" id="search-input" placeholder="Quick search by name, description">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="stateForm" data-form-title="Add New Bot State" class="btn-form-reset toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="stateForm" data-form-title="Add New Bot State" class="btn-form-reset toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Bot State</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                @if($states->isNotEmpty())
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div id="stateTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="table-select-all">
                                                <label class="custom-control-label" for="table-select-all"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Mode</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools"></div>
                                    </div>
                                    @forelse ($states as $state)
                                        <div class="nk-tb-item table-row-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="state-{{ $state->id }}" data-id="{{ $state->id }}">
                                                    <label class="custom-control-label" for="state-{{ $state->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $state->name }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $state->mode }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-state dropdown-state-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="javascript:void(0)" data-target="stateForm" data-url="{{ route('settings.bots.states.show', ['bot' => $bot->id, 'id' => $state->id ]) }}" data-form-title="Edit Bot State" class="toggle btn-action-sidebar-edit"><em class="icon ni ni-edit"></em><span>Update Bot State</span></a></li>
                                                                    <li><a href="javascript:void(0)" class="btn-action-delete" data-url="{{ route('settings.bots.states.delete', ['bot' => $bot->id, 'id' => $state->id ]) }}" data-label="{{ $state->name }}"><em class="icon ni ni-trash"></em><span>Remove Bot State</span></a></li>

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
                                        {{ $states->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $states->links('components.pagination-goto') }}
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
    <div id="stateFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="stateForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Bot State Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('settings.bots.states.store',['bot' => $bot->id,]) }}" id="stateForm">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="state-name">Command</label>
                            <div class="form-control-wrap">
                                <input type="hidden" id="state-id" name="id" key="id">
                                <input type="hidden" id="state-bot-id" name="bot_id" value="{{$bot->id}}">
                                <input type="text" class="form-control" id="state-command" name="command" key="command">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="state-response">Response</label>
                            <div class="form-control-wrap">
                                <textarea type="text" class="form-control" id="state-response" name="response" key="response"></textarea>
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
<x-jqueryTable :tableId="'stateTable'"></x-jqueryTable>
<x-jqueryForm :formId="'stateForm'"></x-jqueryForm>
<script>
    $("#state-user").select2({
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
