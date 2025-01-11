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
                    <h1>Admins</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('add-admin-layout') }}" class="btn btn-primary float-right">New Admin</a>
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
                            <h3 class="card-title">Admin List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Admin</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th style="width: 200px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->is_admin === '1' ? 'Admin' : 'Not Admin' }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->status == 0 ? 'Active' : 'Inactive'}}</td>
                                        <td>
                                            <a href="{{ route('edit-admin', $admin->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="{{ route('delete-admin', $admin->id) }}" class="btn btn-danger" onclick="if(!confirm('Are you sure to delete this admin: {{ $admin->name }}')) return false">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $admins->links() }}
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
