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
                        <form method="post" enctype="multipart/form-data">
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
                                            <input name="sku" value="{{ old('sku', $product->sku) }}" type="text" class="form-control" id="forSKU" placeholder="Enter A SKU Size" required>
                                            <div class="text-danger">{{ $errors->first('sku') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forCategory">Category <span class="text-danger">*</span></label>
                                            <select name="category" class="form-control" id="forCategory" required>
                                                <option selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                <option {{ old('category', $product->category_id) == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger">{{ $errors->first('category') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forSubCategory">Sub Category <span class="text-danger">*</span></label>
                                            <select name="sub_category" class="form-control" id="forSubCategory" required>
                                                <option selected>Select Sub Category</option>
                                                @foreach ($getSubCategories as $subCategories)
                                                <option {{ old('sub_category', $product->sub_category_id) == $subCategories->id ? 'selected' : ''}} value="{{$subCategories->id}}">{{$subCategories->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger">{{ $errors->first('sub_category') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forBrand">Brand <span class="text-danger">*</span></label>
                                            <select name="brand" class="form-control" id="forBrand" required>
                                                <option selected>Select Brand</option>
                                                @foreach ($brands as $brand)
                                                <option {{ old('brand', $product->brand_id) == $brand->id ? 'selected' : '' }} value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger">{{ $errors->first('brand') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="forStatus">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control" id="forStatus">
                                                <option {{ old('status' ,$product->status) == "0" ? 'selected' : '' }} value="0">Active</option>
                                                <option {{ old('status' ,$product->status) == "1" ? 'selected' : '' }} value="1">Inactive</option>
                                            </select>
                                            <div class="text-danger">{{ $errors->first('status') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <label for="forColor">Color <span class="text-danger">*</span></label>
                                    @foreach ($colors as $color)
                                    @php
                                    $isChecked = collect(old('color', $product->productColor->pluck('color_id')->toArray()))->contains($color->id) ? 'checked' : '';
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input name="color[]" value="{{$color->id}}" {{ $isChecked }} class="form-check-input" {{ old("color[$color->id]") == $color->id ? 'checked' : '' }} type="checkbox" id="for{{ucfirst(str_replace(" ", "",$color->name))}}">
                                            <label class="form-check-label" for="for{{ucfirst(str_replace(" ", "",$color->name))}}">
                                                {{ $color->name }}
                                            </label>
                                        </div>
                                    </div>
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
                                                    <th>Name</th>
                                                    <th>Price ($)</th>
                                                    <th style="width: 150px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="appendSize">
                                                @php
                                                $iStoredProduct = 1;
                                                @endphp
                                                @foreach ($product->productSize()->get() as $productSize)
                                                <tr id="DeleteSize{{$iStoredProduct}}">
                                                    <td><input name="size[{{$iStoredProduct}}][name]" value="{{$productSize->size}}" type="text" class="form-control" id="" placeholder="Name"></td>
                                                    <td><input name="size[{{$iStoredProduct}}][price]" value="{{$productSize->price}}" type="text" class="form-control" id="" placeholder="Price"></td>
                                                    <td>
                                                        <button type="button" id="{{$iStoredProduct}}" class="btn btn-danger DeleteSize">Delete</button>
                                                    </td>
                                                </tr>
                                                @php
                                                $iStoredProduct++
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <td><input name="size[100][name]" value="{{ old('size[100][name]') }}" type="text" class="form-control" id="" placeholder="Name"></td>
                                                    <td><input name="size[100][price]" value="{{ old('size[100][price]') }}" type="text" class="form-control" id="" placeholder="Price"></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary AddSize">Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formFileMultiple">Upload Images</label>
                                            <input class="form-control" name="images[]" type="file" id="formFileMultiple" multiple>
                                            @foreach ($errors->get('images.*') as $imagesErrors)
                                            @foreach ($imagesErrors as $imagesError)
                                            <div class="text-danger">{{ $imagesError }}</div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @if (!empty($product->productImages()->get()) && $product->productImages() != null)
                                <div class="row" id="sortable">
                                    @foreach ($product->productImages()->get() as $image)
                                    <div class="col-md-2 sortable_image" id="{{ $image->id }}">
                                        <div class="card" style="width: 10rem; cursor: grab;">
                                            <img src="{{ url($image->path) }}" class="card-img-top" alt="{{ $image->name }}">
                                            <div class="card-body p-2">
                                                <p class="card-text">{{ $image->name }}</p>
                                                <a href="{{ route('delete-product-image', [$product->id, $image->id]) }}" class="btn btn-danger btn-sm" onclick="if(!confirm('Are you sure you want delete this image: {{ $image->name }}')) return false" style="display: block;">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forShortDescription">Short Description <span class="text-danger">*</span></label>
                                            <textarea name="short_description" class="form-control editor" id="forShortDescription" placeholder="Type Short Description">{{ old('short_description', $product->short_description) }}</textarea>
                                            <div class="text-danger">{{ $errors->first('short_description') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forDescription">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control editor" id="forDescription" placeholder="Type Description">{{ old('description', $product->description) }}</textarea>
                                            <div class="text-danger">{{ $errors->first('description') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forAdditionalInformation">Additional Information <span class="text-danger">*</span></label>
                                            <textarea name="additional_information" class="form-control editor" id="forShortDescription" placeholder="Type Additional Information">{{ old('additional_information', $product->additional_information) }}</textarea>
                                            <div class="text-danger">{{ $errors->first('additional_information') }}</div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="forShippingReturns">Shipping Returns <span class="text-danger">*</span></label>
                                            <textarea name="shipping_returns" class="form-control editor" id="forShippingReturns" placeholder="Type Shipping Returns">{{ old('shipping_returns',$product->shipping_returns) }}</textarea>
                                            <div class="text-danger">{{ $errors->first('shipping_returns') }}</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
<script>
    $(document).ready(function() {
        $("#sortable").sortable({
            update: function(event, ui) {
                let photo_id = new Array();
                $('.sortable_image').each(function() {
                    let id = $(this).attr('id')
                    photo_id.push(id);
                });

                $.ajax({
                    type: "POST",
                    url: "/admin/products/sorting_images",
                    data: {
                        'photo_id': photo_id,
                        "_token": "{{csrf_token()}}"
                    },
                    dataType: "json",
                    success: function(data) {

                    },
                    error: function(data) {

                    }
                });
            }
        });
    });
</script>
<script>
    let i = 101;
    $('body').delegate('.AddSize', 'click', function() {
        let html = "<tr id='DeleteSize" + i + "'>\n\
                        <td><input name='size[" + i + "][name]' value='' type='text' class='form-control' id='' placeholder='Name' required></td>\n\
                        <td><input name='size[" + i + "][price]' value='' type='text' class='form-control' id='' placeholder='Price'></td>\n\
                        <td>\n\
                            <button type='button' id='" + i + "' class='btn btn-danger DeleteSize'>Delete</button>\n\
                        </td>\n\
                    </tr>";
        i++;
        $('#appendSize').append(html);
    });

    $('body').delegate('.DeleteSize', 'click', function() {
        let id = $(this).attr('id');
        $('#DeleteSize' + id).remove();
    });
</script>
<script>
    $('body').delegate("#forCategory", 'change', function(e) {
        let id = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{ route('sub_category-ajax') }}",
            data: {
                "id": id,
                "_token": "{{csrf_token()}}"
            },
            dataType: "json",
            success: function(data) {
                $('#forSubCategory').html("<option selected>Select Sub Category</option>");
                $('#forSubCategory').append(data.html);
            },
            error: function(data) {

            }
        });
    });
</script>
@endsection
