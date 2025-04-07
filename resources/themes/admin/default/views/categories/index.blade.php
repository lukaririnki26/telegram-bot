@extends('master.layout')
@section('title', 'Categories')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Categories</h3>
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
                                                <input type="text" class="form-control input-filter" data-target="categoryTable" id="search-input" placeholder="Quick search by name, description">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" data-target="categoryForm" data-form-title="Add New Category" class="btn-form-reset toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" data-target="categoryForm" data-form-title="Add New Category" class="btn-form-reset toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
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
                                <div id="categoryTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="table-select-all">
                                                <label class="custom-control-label" for="table-select-all"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Name</span></div>
                                        <div class="nk-tb-col"><span>Slug</span></div>
                                        <div class="nk-tb-col"><span>Description</span></div>
                                        <div class="nk-tb-col"><span>Num of Childrens</span></div>
                                        <div class="nk-tb-col"><span>Num of Pivots</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools"></div>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="nk-tb-item table-row-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="category-{{ $category->id }}" data-id="{{ $category->id }}">
                                                    <label class="custom-control-label" for="category-{{ $category->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-product">
                                                    @if($category?->getNumOfChildrens() > 0)
                                                        <a href="{{ route('posts.categories.child-index', $category->id) }}">
                                                            <span class="title">{{ $category->name }}</span>
                                                        </a>
                                                    @else
                                                        <span class="title">{{ $category->name }}</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $category?->slug }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $category?->description }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $category?->getNumOfChildrens() ?? 0 }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $category?->getNumOfPivots() ?? 0 }}</span>
                                            </div>

                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="javascript:void(0)" data-target="categoryForm" data-url="{{ route('categories.show', [ 'id' => $category->id ]) }}" data-form-title="Edit Category" class="toggle btn-action-sidebar-edit"><em class="icon ni ni-edit"></em><span>Update Category</span></a></li>
                                                                    @if($category?->getNumOfChildrens() > 0 && $category?->getNumOfPivots() > 0)
                                                                        <li><a href="javascript:void(0)" class="btn-action-delete" data-url="{{ route('categories.delete', [ 'id' => $category->id ]) }}" data-label="{{ $category->name }}"><em class="icon ni ni-trash"></em><span>Remove Category</span></a></li>
                                                                    @else
                                                                        <li><a href="javascript:void(0)" class="btn-action-lock" data-label="{{ $category->name }}"><em class="icon ni ni-lock"></em><span>Remove Category</span></a></li>
                                                                    @endif
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
                                        {{ $categories->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $categories->links('components.pagination-goto') }}
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
    <div id="categoryFormContainer" class="nk-add-product toggle-slide toggle-slide-right" data-content="categoryForm" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 data-content="form-title" class="nk-block-title">Category Form</h5>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <form data-url="{{ route('categories.store') }}" id="categoryForm">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="product-title">Name</label>
                            <div class="form-control-wrap">
                                <input type="hidden" id="category-id" name="id" key="id">
                                <input type="text" class="form-control input-slug" data-target="category-slug" id="category-title" name="name" key="title">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="regular-price">Slug</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="category-slug" name="slug" key="slug">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="sale-price">Description</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control no-resize" id="category-description" name="description" key="description"></textarea>
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
<x-jqueryTable :tableId="'categoryTable'"></x-jqueryTable>
<x-jqueryForm :formId="'categoryForm'"></x-jqueryForm>
@endpush
