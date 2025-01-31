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
                    <h1>Edit Brand</h1>
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
                            <h3 class="card-title">Edit Brand</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="forName">Name <span class="text-danger">*</span></label>
                                    <input name="name" value="{{ old('name', $brand->name) }}" type="text" class="form-control" id="forName" placeholder="Enter Name" required>
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forStatus">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control" id="forStatus">
                                        <option {{ $brand->status == "0" ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ $brand->status == "1" ? 'selected' : '' }} value="1">Inactive</option>
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
                                <div class="form-group">
                                    <label for="forMetaTitle">Meta Title</label>
                                    <input name="meta_title" value="{{ old('meta_title', $brand->meta_title) }}" type="text" class="form-control" id="forMetaTitle" placeholder="Enter meta title">
                                    <div class="text-danger">{{ $errors->first('meta_title') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forMetaDescription">Meta Description</label>
                                    <textarea name="meta_description" type="text" class="form-control" id="forMetaDescription" placeholder="Enter meta description" style="height: 150px;">{{ old('meta_description', $brand->meta_description) }}</textarea>
                                    <div class="text-danger">{{ $errors->first('meta_description') }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="forMetaKeywords">Meta Keywords</label>
                                    <input name="meta_keywords" value="{{ old('meta_keywords', $brand->meta_keywords) }}" type="text" class="form-control" id="forMetaKeywords" placeholder="Enter Keywords">
                                    <div class="text-danger">{{ $errors->first('meta_keywords') }}</div>
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
