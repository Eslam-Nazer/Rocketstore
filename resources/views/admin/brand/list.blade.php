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
                    <h1>Brands</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('add-brand') }}" class="btn btn-primary float-right">New Brand</a>
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
                            <h3 class="card-title">Brands List</h3>
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
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>{{ $brand->meta_title }}</td>
                                        <td>{{ $brand->meta_description }}</td>
                                        <td>{{ $brand->meta_keywords }}</td>
                                        <td>{{ $brand->creator_name }}</td>
                                        <td>{{ $brand->status == '0' ? 'Active' : "Inactive" }}</td>
                                        <td>{{ date('d-m-Y', strtotime($brand->created_at)) }}</td>
                                        <td>
                                            <a href="{{ route('edit-brand', $brand->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('delete-brand', $brand->id) }}" class="btn btn-danger" onclick="if(!confirm('Are you sure to delete this brand: {{ $brand->name }}')) return false">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
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
