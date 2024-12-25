@extends('admin.layouts.app')

@section('styles')

@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Admin</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Admin</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="forName">Name</label>
                                    <input name="name" value="{{ old('name', $admin->name) }}" type="text" class="form-control" id="forName" placeholder="Enter Name">
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forEmail">Email address</label>
                                    <input name="email" value="{{ old('email' ,$admin->email) }}" type="email" class="form-control" id="forEmail" placeholder="Enter email">
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forPassword">Password</label>
                                    <input name="password" type="password" class="form-control" id="forPassword" placeholder="Password">
                                    <p>If you want to chabge password enter it</p>
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forStatus">Status</label>
                                    <select name="status" class="form-control" id="forStatus">
                                        <option {{ $admin->status == 0 ? 'selected' : "" }} value="0">Active</option>
                                        <option {{ $admin->status == 1 ? 'selected' : "" }} value="1">Inactive</option>
                                    </select>
                                    <div class="text-danger">{{ $errors->first('status') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')

@endsection
