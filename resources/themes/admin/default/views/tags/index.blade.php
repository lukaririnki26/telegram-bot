@extends('master.layout')
@section('title', 'Tags')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">@lang('admin.tags')</h3>
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
                                                <input type="text" class="form-control input-filter" data-target="tagTable" id="search-input" placeholder="@lang('admin.quick_search_by_name')">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="tagForm" data-form-title="Add New Tag" class="btn-form-reset toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="tagForm" data-form-title="Add New Tag" class="btn-form-reset toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>@lang('admin.add_tag')</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div id="tagTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="table-select-all">
                                                <label class="custom-control-label" for="table-select-all"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>@lang('admin.name')</span></div>
                                        <div class="nk-tb-col"><span>@lang('admin.slug')</span></div>
                                        <div class="nk-tb-col"><span>@lang('admin.description')</span></div>
                                        <div class="nk-tb-col"><span>@lang('admin.num_of_pivots')</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#" data-url="{{ route('posts.tags.remove-selected') }}" class=".btn-remove-selected"><em class="icon ni ni-trash"></em><span>@lang('admin.remove_selected')</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @foreach ($tags as $tag)
                                        <div class="nk-tb-item table-row-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="tag-{{ $tag->id }}" data-id="{{ $tag->id }}">
                                                    <label class="custom-control-label" for="tag-{{ $tag->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-product">
                                                    <span class="title">{{ $tag->name }}</span>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $tag?->slug }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $tag?->description }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $tag?->count ?? 0 }}</span>
                                            </div>

                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li>
                                                                        <a href="javascript:void(0)" data-target="tagForm" data-url="{{ route('posts.tags.show', [ 'id' => $tag->id ]) }}" data-form-title="@lang('admin.edit_tag')" class="toggle btn-action-sidebar-edit">
                                                                            <em class="icon ni ni-edit"></em><span>@lang('admin.edit_tag')</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0)" class="btn-action-delete" data-url="{{ route('posts.tags.delete', [ 'id' => $tag->id ]) }}" data-label="{{ $tag->name }}">
                                                                            <em class="icon ni ni-trash"></em><span>@lang('admin.remove_tag')</span>
                                                                        </a>
                                                                    </li>
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
                                        {{ $tags->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $tags->links('components.pagination-goto') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
@endsection
@push('form')
    <div id="tagFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="tagForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Tag Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('posts.tags.store') }}" id="tagForm">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="product-title">@lang('admin.name')</label>
                            <div class="form-control-wrap">
                                <input type="hidden" id="tag-id" name="id" key="id">
                                <input type="text" class="form-control input-slug" data-target="tag-slug" id="tag-name" name="name" key="name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="regular-price">@lang('admin.slug')</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="tag-slug" name="slug" key="slug">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="sale-price">@lang('admin.description')</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control no-resize" id="tag-description" name="description" key="description"></textarea>
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
<x-jqueryTable :tableId="'tagTable'"></x-jqueryTable>
<x-jqueryForm :formId="'tagForm'"></x-jqueryForm>
@endpush
