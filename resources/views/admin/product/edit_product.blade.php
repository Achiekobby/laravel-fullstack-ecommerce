@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Edit</h4>
                <h6>Edit product</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.update', ['uuid' => $product->uuid]) }}" method="POST"
                    enctype="multipart/form-data">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Product Name<span class="text-danger">*</span></label>
                                <input type="text" name="product_name" value="{{ $product->name }}" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category<span class="text-danger">*</span></label>
                                <select id="category" class="form-control" name="category_id">
                                    @if (is_null($product->category_id))
                                        <option value="">Assign a Category</option>
                                    @else
                                        <option value="{{ $product->category->id }}">{{ $product->category->category_name }}
                                    @endif
                                    </option>
                                    @php
                                        $categories = \App\Models\General\Category::get();
                                    @endphp
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ \Illuminate\Support\Str::title($category->category_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <h1>{{$product->subcategory->name}}</h1> --}}
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub Category<span class="text-danger">*</span></label>
                                <select class="form-control" id="subCategory" name="subcategory_id">
                                    @if (is_null($product->subcategory_id))
                                        <option value="">Assign a New Subcategory</option>
                                    @else
                                        <option value="{{ $product->subcategory_id }}">{{ $product->subcategory->name }}
                                    @endif
                                    </option>
                                    @php
                                        $subcategories = \App\Models\General\Subcategory::get();
                                    @endphp
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand</label>
                                <input type="text" name="brand" value="{{ $product->brand }}">
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Regular Price<span class="text-danger">*</span></label>
                                <input id="reg_price" type="text" name="regular_price"
                                    value="{{ (int) $product->regular_price }}" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sales Price</label>
                                <input id="sale_price" type="text" name="sales_price"
                                    value="{{ (int) $product->sales_price }}" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount(%)</label>
                                <input id="discount" readonly type="text" name="discount"
                                    value="{{ $product->discount_percentage }}" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Quantity<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity"
                                    value="{{ $product->quantity }}" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description<span class="text-danger">*</span></label>
                                <textarea id="description" class="form-control" rows="6" name="description">{!! $product->description !!}</textarea>
                            </div>
                        </div>


                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="status">
                                    <option value="active">{{ $product->status }}</option>
                                    @if ($product->status === 'active')
                                        <option value="inactive">Inactive</option>
                                    @else
                                        <option value="active">Active</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Product Image(1)<span class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_one" id="image_one" class="form-control"
                                            onchange="showImageHereFunc('image_one','showImage_one','pre_showImage_one');" />
                                    </div>
                                </div>
                                <div class="row" id="pre_showImage_one">
                                    <div class='col-lg-3 col-sm-6 col-12 mb-3'>
                                        <img style='width:100%;height:100px; object-fit:contain; ' class='card-img-top'
                                            src='{{ asset('/uploads/products/' . $product->photos['image_one']) }}'>
                                    </div>
                                </div>
                                <div class="row" id="showImage_one">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Product Image(2)<span class=""></span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_two" id="image_two" class="form-control"
                                            onchange="showImageHereFunc('image_two','showImage_two','pre_showImage_two');" />
                                    </div>
                                </div>
                                <div class="row" id="pre_showImage_two">
                                    @if (array_key_exists('image_two', $product->photos))
                                        <div class='col-lg-3 col-sm-6 col-12 mb-3'>
                                            <img style='width:100%;height:100px; object-fit:contain; '
                                                class='card-img-top'
                                                src='{{ asset('/uploads/products/' . $product->photos['image_two']) }}'>
                                        </div>
                                    @endif
                                </div>

                                <div class="row" id="showImage_two">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Product Image(3)<span class=""></span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_three" id="image_three" class="form-control"
                                            onchange="showImageHereFunc('image_three','showImage_three','pre_showImage_three');" />
                                    </div>
                                </div>
                                <div class="row" id="pre_showImage_three">
                                    @if (array_key_exists('image_three', $product->photos))
                                        <div class='col-lg-3 col-sm-6 col-12 mb-3'>
                                            <img style='width:100%;height:100px; object-fit:contain; '
                                                class='card-img-top'
                                                src='{{ asset('/uploads/products/' . $product->photos['image_three']) }}'>
                                        </div>
                                    @endif
                                </div>
                                <div class="row" id="showImage_three">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label> Product Image(4)<span class=""></span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_four" id="image_four" class="form-control"
                                            onchange="showImageHereFunc('image_four','showImage_four','pre_showImage_four');" />
                                    </div>
                                </div>
                                <div class="row" id="pre_showImage_four">
                                    @if (array_key_exists('image_four', $product->photos))
                                        <div class='col-lg-3 col-sm-6 col-12 mb-3'>
                                            <img style='width:100%;height:100px; object-fit:contain; '
                                                class='card-img-top'
                                                src='{{ asset('/uploads/products/' . $product->photos['image_four']) }}'>
                                        </div>
                                    @endif
                                </div>
                                <div class="row" id="showImage_four">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Edit Product</button>
                            <a href="{{ route('admin.products') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.0/classic/ckeditor.js"></script>

<script>
    $(document).ready(function() {
        // const subcategoryDropdown = $('#subCategory');

        // const initial_subcategory = $('#initial_subcategory').val();
        // const initial_subcategory_text = $('#initial_subcategory').text();

        // // Function to fetch and populate subcategories
        // function fetchAndPopulateSubcategories(categoryId) {
        //     // Append the initial option
        //     subcategoryDropdown.empty().append(
        //         `<option value='${initial_subcategory}'>${initial_subcategory_text}</option>`);

        //     $.ajax({
        //         url: '/get-subcategories/' + categoryId,
        //         type: 'GET',
        //         success: function(data) {
        //             subcategoryDropdown.empty().append(
        //         `<option value='${initial_subcategory}'>${initial_subcategory_text}</option>`);

        //             console.log("subcategories", data);
        //             subcategoryDropdown.empty();
        //             if (data.length > 0) {
        //                 $.each(data, function(key, value) {
        //                     subcategoryDropdown.append('<option value="' + value.id + '">' +
        //                         value.name + '</option>');
        //                 });
        //             }
        //         }
        //     });
        // }

        // // Fetch subcategories initially based on the preselected category
        // const initialCategoryId = $('#category').val();
        // fetchAndPopulateSubcategories(initialCategoryId);

        // $('#category').change(function() {
        //     const categoryId = $(this).val();
        //     console.log("category_id", categoryId);
        //     if (categoryId) {
        //         fetchAndPopulateSubcategories(categoryId);
        //     } else {
        //         subcategoryDropdown.empty();
        //     }
        // });

        // Function to update discount
        function updateDiscount() {
            const regPrice = parseFloat($('#reg_price').val());
            const salePrice = parseFloat($('#sale_price').val());

            // Check if sale price is greater than regular price
            if (salePrice > regPrice) {
                alert("Sales price cannot be greater than regular price!");
                $('#sale_price').val(regPrice);
            }

            // Calculate and update discount percentage
            const discount = (salePrice === 0 || isNaN(salePrice)) ? 0 : Math.ceil(((regPrice - salePrice) /
                regPrice) * 100);

            $('#discount').val(discount);
        }

        // Event listeners for price inputs
        $('#reg_price, #sale_price').on('input', function() {
            updateDiscount();
        });

        // Initial call to set discount on page load
        updateDiscount();
    });


    function showImageHereFunc(id, showImage_section, prev_image) {
        const fileInput = document.getElementById(id);
        const files = fileInput.files;
        const prev_image_ref = document.getElementById(prev_image)

        if (files.length > 0) {
            prev_image_ref.style.display = 'none';
            const file = files[0];
            const imageSrc = URL.createObjectURL(file);

            $(`#${showImage_section}`).append(
                "<div class='col-lg-3 col-sm-6 col-12 mb-3'><img style='width:100%;height:100px; object-fit:contain; ' class='card-img-top' src='" +
                imageSrc + "'></div>"
            );
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
