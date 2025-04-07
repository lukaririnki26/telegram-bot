@extends('master.layout')
@section('title', 'Admin Pages')

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Pages</h3>
                        </div><!-- .nk-block-head-content -->
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
                                                <input type="text" class="form-control input-filter" data-target="pagesTable" id="search-input" placeholder="Quick search by name, description">
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="{{ route('pages.create') }}" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                            <a href="{{ route('pages.create') }}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Page</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <div id="pagesTable" class="nk-tb-list">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col tb-col-sm"><span>Title</span></div>
                                        <div class="nk-tb-col"><span>Last Update</span></div>
                                        <div class="nk-tb-col"><span>Blocks</span></div>
                                        <div class="nk-tb-col"><span>Access</span></div>
                                        <div class="nk-tb-col nk-tb-col-tools"></div>
                                    </div><!-- .nk-tb-item -->
                                    @foreach ($pages as $page)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-product">
                                                    <span class="title">{{ $page->title }}</span>
                                                </span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-sub"><strong>Updated By</strong> {{ implode(' at ', [$page?->last_update['updated_by']?->name ?? 'Unknown', $page?->last_update['updated_at']?->format('d M Y, H:i')]) }}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-lead">-</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                @if($page->record_visibility === 'PUBLIC')
                                                    <span class="badge bg-success">{{ ucfirst(strtolower($page->record_visibility)) }}</span>
                                                @elseif($page->record_visibility === 'READONLY')
                                                    <span class="badge bg-light">{{ ucfirst(strtolower($page->record_visibility)) }}</span>
                                                @elseif($page->record_visibility === 'PROTECTED')
                                                    <span class="badge bg-warning">{{ ucfirst(strtolower($page->record_visibility)) }}</span>
                                                @elseif($page->record_visibility === 'PRIVATE')
                                                    <span class="badge bg-danger">{{ ucfirst(strtolower($page->record_visibility)) }}</span>
                                                @elseif($page->record_visibility === 'MEMBER_ONLY')
                                                    <span class="badge bg-info">{{ ucfirst(strtolower($page->record_visibility)) }}</span>
                                                @endif

                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1 my-n1">
                                                    <li class="me-n1">
                                                        <div class="dropdown">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="{{ route('pages.update', [ 'id' => $page->id ]) }}"><em class="icon ni ni-edit"></em><span>Update Page</span></a></li>
                                                                    <li><a href="{{ route('page.show', ['slug' => $page->slug ]) }}" target="_blank"><em class="icon ni ni-dashboard"></em><span>Manage Blocks</span></a></li>
                                                                    <li><a href="{{ route('page.show', ['slug' => $page->slug ]) }}" target="_blank"><em class="icon ni ni-eye"></em><span>Show Page</span></a></li>
                                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Page</span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    @endforeach
                                </div><!-- .nk-tb-list -->
                            </div>
                            <div class="card-inner">
                                <div class="nk-block-between-md g-3">
                                    <div class="g">
                                        {{ $pages->links('components.pagination') }}
                                    </div>
                                    <div class="g">
                                        <div class="pagination-goto d-flex justify-content-center justify-content-md-start gx-3">
                                            {{ $pages->links('components.pagination-goto') }}
                                        </div>
                                    </div><!-- .pagination-goto -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
@endsection
