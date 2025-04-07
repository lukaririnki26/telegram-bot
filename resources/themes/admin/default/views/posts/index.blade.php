@extends('master.layout')
@section('title', 'Posts')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Posts</h3>
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
                                                <input type="text" class="form-control input-filter" data-target="postsTable" id="search-input" placeholder="Quick search by name, description">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="{{ route('posts.create') }}" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="{{ route('posts.create') }}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Post</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div id="postsTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-col-check">
                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                <input type="checkbox" class="custom-control-input" id="select-all">
                                                <label class="custom-control-label" for="select-all"></label>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm"><span>Title</span></div>
                                        <div class="nk-tb-col"><span>Category</span></div>
                                        <div class="nk-tb-col"><span>Last Update</span></div>
                                        <div class="nk-tb-col"><span>Access</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools">
                                            <ul class="nk-tb-actions gx-1 my-n1">
                                                <li class="me-n1">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>Publish Selected</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-eye-off"></em><span>Unpublish Selected</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Selected</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @foreach ($posts as $post)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="post-{{ $post->id }}">
                                                    <label class="custom-control-label" for="post-{{ $post->id }}"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-product">
                                                    <img src="/themes/admin/default/assets/images/product/a.png" alt="" class="thumb">
                                                    <span class="title">{{ $post->title }}</span>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub">{{ $post?->category ?? 'Uncategorized' }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub"><strong>Updated By</strong> {{ implode(' at ', [$post?->last_update['updated_by']?->name ?? 'Unknown', $post?->last_update['updated_at']?->format('d M Y, H:i')]) }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                @if($post->record_visibility === 'PUBLIC')
                                                    <span class="badge bg-success">{{ ucfirst(strtolower($post->record_visibility)) }}</span>
                                                @elseif($post->record_visibility === 'READONLY')
                                                    <span class="badge bg-light">{{ ucfirst(strtolower($post->record_visibility)) }}</span>
                                                @elseif($post->record_visibility === 'PROTECTED')
                                                    <span class="badge bg-warning">{{ ucfirst(strtolower($post->record_visibility)) }}</span>
                                                @elseif($post->record_visibility === 'PRIVATE')
                                                    <span class="badge bg-danger">{{ ucfirst(strtolower($post->record_visibility)) }}</span>
                                                @elseif($post->record_visibility === 'MEMBER_ONLY')
                                                    <span class="badge bg-info">{{ ucfirst(strtolower($post->record_visibility)) }}</span>
                                                @endif

                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="{{ route('posts.update', [ 'id' => $post->id ]) }}"><em class="icon ni ni-edit"></em><span>Update Post</span></a></li>
                                                                    <li><a href="{{ route('post.show', ['slug' => $post->slug ]) }}" target="_blank"><em class="icon ni ni-eye"></em><span>Show Post</span></a></li>
                                                                    <li><a href="{{ route('posts.delete', [ 'id' => $post->id ]) }}" onclick="return confirm('Are you sure?')"><em class="icon ni ni-trash"></em><span>Remove Post</span></a></li>
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
                                        {{ $posts->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $posts->links('components.pagination-goto') }}
                                        </div>
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
