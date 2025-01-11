@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')

<div class="content-wrapper">
    @include('admin.layouts._message')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('add-category-layout') }}" class="btn btn-primary float-right">New Category</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Meta Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keyword</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>Created at</th>
                                        <th style="width: 150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->meta_title }}</td>
                                        <td>{{ $category->meta_description }}</td>
                                        <td>{{ $category->meta_keywords }}</td>
                                        <td>{{ $category->creator_name }}</td>
                                        <td>{{ $category->status == '0' ? 'Active' : "Inactive" }}</td>
                                        <td>{{ date('d-m-Y', strtotime($category->created_at)) }}</td>
                                        <td style="width: 150px;padding: 0.5rem">
                                            <a href="{{ route('edit-category', $category->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('delete-category', $category->id) }}" class="btn btn-danger" onclick="if(!confirm('Are you sure to delete this category: {{ $category->name }}')) return false">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $categories->links() }}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection

@section('script')

@endsection
