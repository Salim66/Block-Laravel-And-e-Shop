@extends('layouts.app')

@section('main')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    @include('validate')
                    <a class="btn btn-primary" href="#post-add-modal" data-toggle="modal">Add new Post</a>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Posts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tigle</th>
                                        <th>Category</th>
                                        <th>Tag</th>
                                        <th>Featured Image</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach( $all_data as $data )
                                    <tr>
                                        <td>{{ $loop -> index + 1 }}</td>
                                        <td>{{ $data -> title }}</td>
                                        <td>
                                            @foreach($data -> categories as $category)
                                                {{ $category -> name }} |
                                            @endforeach
                                        </td>
                                        <td></td>
                                        <td>
                                            @if( !empty($data -> featured_image) )
                                            <img style="width: 60px; height: 60px;" src="{{ URL::to('/') }}/media/posts/{{ $data -> featured_image }}" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data -> created_at -> diffForHumans() }}
                                        </td>
                                        <td>
                                            @if( $data -> status == 'Published' )
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-danger">Unpublished</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $data -> status == 'Published' )
                                                <a href="{{ route('post.unpublished', $data->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-eye-slash"></i></a>
                                            @else
                                                <a href="{{ route('post.published', $data->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                            @endif
                                            <a id="edit_post" edit_id="{{ $data->id }}" class="btn btn-warning btn-sm" href="#" data-toggle="modal">Edit</a>
                                                <form class="d-inline" action="{{ route('post.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


{{--Start Category Add Modal--}}
            <div id="post-add-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Post</h4>
                            <button class="close float-left" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input name="title" class="form-control" type="text" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <label for="">Category</label>
                                        @foreach($categories as $category)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="category[]" value="{{ $category->id }}"> {{ $category->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="label_img" class="text-success bg-gradient" for="f_image"><i class="far fa-file-image fa-5x"></i></label>
                                    <input name="featured_image" class="d-none" type="file" id="f_image" >
                                    <img class="w-100" id="post_featured_image_load" src="" alt="">
                                </div>
                                <textarea id="text_editor" name="content"></textarea>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="Add new">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>{{--End Category Add Modal--}}


            {{--Start Category Edit Modal--}}
            <div id="post_modal_edit" class="modal fade">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Post</h4>
                            <button class="close float-left" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input name="title" class="form-control" type="text" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <label for="">Category</label>
                                        <div class="cl"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label id="label_img" class="text-success bg-gradient" for="f_image"><i class="far fa-file-image fa-5x"></i></label>
                                    <input name="featured_image" class="d-none" type="file" id="f_image" >
                                    <img class="w-100" id="post_featured_image_load" src="" alt="">
                                </div>
                                <textarea id="text_editor_edit" name="content"></textarea>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="Add new">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>{{--End Category Edit Modal--}}

        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection
