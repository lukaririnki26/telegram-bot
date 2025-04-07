@extends('master.layout')
@section('title', 'Posts')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Add Post</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-lg-8">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <form action="#">
                                            <div class="row g-gs">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="addTitle" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    {{url('/')}}/blog/
                                                                </div>
                                                            </div>
                                                            <input name="slug" type="text" class="form-control" id="slug">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <div class="summernote-lg summernote-minimal">
                                                                <p>Hello World!</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- .card -->
                                <div class="card">
                                    <div id="accordion" class="accordion">
                                        <div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-6">
                                                <h6 class="title">Page Seo</h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-6" data-bs-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <div class="row g-3 align-center">
                                                        <div class="col-lg-5 mb-auto">
                                                            <div class="form-group">
                                                                <label class="form-label" for="site-name">Meta Description</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <textarea class="form-control no-resize" cols="5"></textarea>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col-lg-5 mb-auto">
                                                            <div class="form-group">
                                                                <label class="form-label" for="site-name">Meta Keyword</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div id="accordion" class="accordion">
                                        <div class="accordion-item">
                                            <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">
                                                <h6 class="title">Language</h6>
                                                <span class="accordion-icon"></span>
                                            </a>
                                            <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                                                <div class="accordion-inner">
                                                    <div class="form-group">
                                                        <div class="form-control-wrap">
                                                            <select class="form-select js-select2">
                                                                <option value="English">English</option>
                                                                <option value="Indonesia">Indonesia</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div id="category-accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-2">
                                                    <h6 class="title">Category</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse" id="accordion-item-2" data-bs-parent="#category-accordion">
                                                    <div class="accordion-inner">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2">
                                                                    <option value="English">Read Up</option>
                                                                    <option value="Indonesia">Make Up</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div id="category-accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-7">
                                                    <h6 class="title">Tags</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse" id="accordion-item-7" data-bs-parent="#category-accordion">
                                                    <div class="accordion-inner">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="addTags" placeholder="Tags">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div id="publish-accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-3">
                                                    <h6 class="title">Publish</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse" id="accordion-item-3" data-bs-parent="#publish-accordion">
                                                    <div class="accordion-inner">
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="site-name">Visibility</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select js-select2">
                                                                            <option value="Publish">Publish</option>
                                                                            <option value="Draft">Draft</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="site-name">Date</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <div class="form-icon form-icon-right">
                                                                            <em class="icon ni ni-calendar"></em>
                                                                        </div>
                                                                        <input type="text" class="form-control date-picker" id="addDate" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="col-12">
                                                                <a href="#" class="btn btn-sm btn-dark"><em class="icon ni ni-todo-fill"></em><span>Update</span> </a>
                                                                <a href="#" class="btn btn-sm btn-warning ms-4"><em class="icon ni ni-note-add-fill-c"></em><span>As New</span> </a>
                                                                <a href="#" class="btn btn-sm btn-danger mt-3"><em class="icon ni ni-trash-fill"></em><span>Delete</span> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div id="category-accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-4">
                                                    <h6 class="title">Featured Image</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse" id="accordion-item-4" data-bs-parent="#category-accordion">
                                                    <div class="accordion-inner">
                                                        <div class="form-control-wrap">
                                                            <input type="file" class="dropify" id="input-file" name="featured_image" key="featured_image"
                                                                data-default-file="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div id="category-accordion" class="accordion">
                                            <div class="accordion-item">
                                                <a href="#" class="accordion-head collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-item-5">
                                                    <h6 class="title">Settings</h6>
                                                    <span class="accordion-icon"></span>
                                                </a>
                                                <div class="accordion-body collapse" id="accordion-item-5" data-bs-parent="#category-accordion">
                                                    <div class="accordion-inner">
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="site-name">Ordering</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <div class="form-control-wrap number-spinner-wrap">
                                                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-minus" data-number="minus">
                                                                        <em class="icon ni ni-minus"></em>
                                                                    </button>
                                                                    <input type="number" class="form-control number-spinner" value="0">
                                                                    <button class="btn btn-icon btn-outline-light number-spinner-btn number-plus" data-number="plus">
                                                                        <em class="icon ni ni-plus"></em>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="col-lg-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="addComment">
                                                                    <label class="custom-control-label" for="addComment">Show Author</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="addComment">
                                                                    <label class="custom-control-label" for="addComment">Show Date</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="col-lg-12">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="addComment">
                                                                    <label class="custom-control-label" for="addComment">Show Comments</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
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
