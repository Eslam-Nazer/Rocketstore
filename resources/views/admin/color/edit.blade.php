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
                    <h1>Add New Color</h1>
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
                            <h3 class="card-title">New Color</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="forName">Name <span class="text-danger">*</span></label>
                                    <input name="name" value="{{ old('name', $color->name) }}" type="text" class="form-control" id="forName" placeholder="Enter Name" required>
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forCode">Code <span class="text-danger">*</span></label>
                                    <input name="code" value="{{ old('code', $color->code) }}" type="color" class="form-control form-control-color" id="forCode" placeholder="Choose your color" required>
                                    <div class="text-danger">{{ $errors->first('color') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forStatus">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" id="forStatus">
                                        <option {{ old('status', $color->status) == 0 ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ old('status', $color->status) == 1 ? 'selected' : '' }} value="1">Inactive</option>
                                    </select>
                                    <div class="text-danger">{{ $errors->first('status') }}</div>
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
