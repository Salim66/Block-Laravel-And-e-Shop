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
                <div class="col-lg-10">
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
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Featured Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach( $all_data as $data )
                                    <tr>
                                        <td>{{ $loop -> index + 1 }}</td>
                                        <td>{{ $data -> name }}</td>
                                        <td>{{ $data -> slug }}</td>
                                        <td>
                                            @if( $data -> status == 'Published' )
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-danger">Unpublished</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $data -> status == 'Published' )
                                                <a href="{{ route('tag.unpublished', $data->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-eye-slash"></i></a>
                                            @else
                                                <a href="{{ route('tag.published', $data->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                            @endif
                                            <a id="edit_tag" edit_id="{{ $data->id }}" class="btn btn-warning btn-sm" href="#post-edit-modal" data-toggle="modal">Edit</a>
                                                <form class="d-inline" action="{{ route('post-tag.destroy', $data->id) }}" method="POST">
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
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('post-tag.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="name" class="form-control" type="text" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-10">
                                        @foreach($categories as $category)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="checkbox[]"> {{ $category->name }}
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
                                <textarea id="text_editor"></textarea>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="Add new">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>{{--End Category Add Modal--}}


            {{--Start Category Edit Modal--}}
            <div id="post-edit-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Post</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('tag.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input name="name" class="form-control" type="text" placeholder="Name">
                                    <input name="id" type="hidden">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="Update">
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