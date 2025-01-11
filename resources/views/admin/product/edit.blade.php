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
                    <h1>Edit Product</h1>
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
                            <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forTitle">Title <span class="text-danger">*</span></label>
                                            <input name="title" value="{{ old('title', $product->title) }}" type="text" class="form-control" id="forTitle" placeholder="Enter Name" required>
                                            <div class="text-danger">{{ $errors->first('title') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forSKU">SKU <span class="text-danger">*</span></label>
                                            <input name="sku" value="{{ old('sku',) }}" type="text" class="form-control" id="forSKU" placeholder="Enter A SKU Size" required>
                                            <div class="text-danger">{{ $errors->first('title') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forSubCategory">Sub Category <span class="text-danger">*</span></label>
                                            <select name="sub_category" class="form-control" id="forSubCategory" required>
                                                <option selected>Select Sub Category</option>
                                                @foreach ($sub_categories as $sub_category)
                                                @if ($sub_category->status === '0')
                                                <option {{ old('sub_category') == $sub_category->id ? 'selected' : '' }} value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="text-danger">{{ $errors->first('sub_category') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forCategory">Category <span class="text-danger">*</span></label>
                                            <select name="category" class="form-control" id="forCategory" required>
                                                <option selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                @if ($category->status === '0')
                                                <option {{ old('category') == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="text-danger">{{ $errors->first('category') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forBrand">Brand <span class="text-danger">*</span></label>
                                            <select name="brand" class="form-control" id="forBrand" required>
                                                <option selected>Select Brand</option>
                                                @foreach ($brands as $brand)
                                                @if ($brand->status === '0')
                                                <option {{ old('brand') == $brand->id ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="text-danger">{{ $errors->first('brand') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forStatus">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control" id="forStatus">
                                                <option {{ $category->status == "0" ? 'selected' : '' }} value="0">Active</option>
                                                <option {{ $category->status == "1" ? 'selected' : '' }} value="1">Inactive</option>
                                            </select>
                                            <div class="text-danger">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <label for="forColor">Color <span class="text-danger">*</span></label>
                                    @foreach ($colors as $color)
                                    @if ($color->status === '0')
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input name="color[]" value="{{$color->id}}" class="form-check-input" type="checkbox" id="for{{ucfirst(str_replace(" ", "",$color->name))}}">
                                            <label class="form-check-label" for="for{{ucfirst(str_replace(" ", "",$color->name))}}">
                                                {{ $color->name }}
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forPrice">Price ($) <span class="text-danger">*</span></label>
                                            <input name="price" value="{{ old('price', $product->price) }}" type="number" class="form-control" id="forPrice" min="0" step="0.001" required>
                                            <div class="text-danger">{{ $errors->first('price') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forOldPrice">Old Price ($) <span class="text-danger">*</span></label>
                                            <input name="old_price" value="{{ old('old_price',$product->old_price) }}" type="number" class="form-control" id="forOldPrice" min="0" step="0.001" required>
                                            <div class="text-danger">{{ $errors->first('old_price') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <label for="forSize">Size <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>Name</th>
                                                    <th>Price ($)</th>
                                                    <th style="width: 150px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><input name="" value="" type="text" class="form-control" id="" placeholder="" required></td>
                                                    <td><input name="" value="" type="text" class="form-control" id="" placeholder="" required></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary">Add</a>
                                                        <a href="#" class="btn btn-danger" onclick="if(!confirm('Are you sure to delete this product: {{ $product->title }}')) return false">Delete</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forShortDescription">Short Description <span class="text-danger">*</span></label>
                                            <textarea name="short_description" class="form-control" id="forShortDescription" placeholder="Type Short Description">{{ $product->short_description }}</textarea>
                                            <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forDescription">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control" id="forDescription" placeholder="Type Description">{{ $product->description }}</textarea>
                                            <div class="text-danger">{{ $errors->first('description') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forAdditionalInformation">Additional Information <span class="text-danger">*</span></label>
                                            <textarea name="additional_information" class="form-control" id="forShortDescription" placeholder="Type Additional Information">{{ $product->additional_information }}</textarea>
                                            <div class="text-danger">{{ $errors->first('additional_information') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forShippingReturns">Shipping Returns <span class="text-danger">*</span></label>
                                            <textarea name="shipping_returns" class="form-control" id="forShippingReturns" placeholder="Type Shipping Returns">{{ $product->shipping_returns }}</textarea>
                                            <div class="text-danger">{{ $errors->first('shipping_returns') }}</div>
                                        </div>
                                    </div>

                                </div>

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
