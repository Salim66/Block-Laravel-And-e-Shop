@extends('layouts.app')

@section('main')
    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
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
                    <a class="btn btn-primary" href="#category-add-modal" data-toggle="modal">Add new category</a>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hover Rows</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
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
                                                <a href="{{ route('category.unpublished', $data->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-eye-slash"></i></a>
                                            @else
                                                <a href="{{ route('category.published', $data->id) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                            @endif
                                            <a id="edit_category" edit_id="{{ $data->id }}" class="btn btn-warning btn-sm" href="#category-edit-modal" data-toggle="modal">Edit</a>
                                                <form class="d-inline" action="{{ route('post-category.destroy', $data->id) }}" method="POST">
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
            <div id="category-add-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Category</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('post-category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="name" class="form-control" type="text" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary btn-block" type="submit" value="Add new">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>{{--End Category Add Modal--}}


            {{--Start Category Edit Modal--}}
            <div id="category-edit-modal" class="modal fade">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Category</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('category.update') }}" method="POST">
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
