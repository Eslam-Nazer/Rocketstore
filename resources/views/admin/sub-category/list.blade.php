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
                    <h1>Sub Categories</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('add-sub_category-layout') }}" class="btn btn-primary float-right">New SubCategory</a>
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
                            <h3 class="card-title">Sub Category List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Sub Category Name</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                        <th>Meta Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keyword</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <!-- <th>Created at</th> -->
                                        <th style="width: 150px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $subCategory)
                                    <tr>
                                        <td>{{ $subCategory->id }}</td>
                                        <td>{{ $subCategory->name }}</td>
                                        <td>{{ $subCategory->category_name }}</td>
                                        <td>{{ $subCategory->slug }}</td>
                                        <td>{{ $subCategory->meta_title }}</td>
                                        <td>{{ $subCategory->meta_description }}</td>
                                        <td>{{ $subCategory->meta_keywords }}</td>
                                        <td>{{ $subCategory->username }}</td>
                                        <td>{{ $subCategory->status == '0' ? 'Active' : "Inactive" }}</td>
                                        <!-- <td>{{ date('d-m-Y' ,strtotime($subCategory->created_at)) }}</td> -->
                                        <td style="width: 150px;padding: 0.5rem">
                                            <a href="{{ route('edit-sub_category-layout', $subCategory->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('delete-sub_category', $subCategory->id) }}" class="btn btn-danger" onclick="if(!confirm('Are you sure to delete this sub category: {{ $subCategory->name }}')) return false">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div style="float: right;">
                                {{ $subCategories->links() }}
                            </div>
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
