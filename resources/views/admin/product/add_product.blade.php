@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add</h4>
                <h6>Create new product</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label class="col-form-label">Product Name<span class="text-danger">*</span></label>
                                <input type="text" name="product_name" />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="col-form-label">Category<span class="text-danger">*</span></label>
                                <select id="category" class="js-example-basic-single" name="category_id">
                                    <option>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ \Illuminate\Support\Str::title($category->category_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="col-form-label">Sub Category<span class="text-danger">*</span></label>
                                <select class="js-example-basic-single" id="subCategory" name="subcategory_id"></select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="col-form-label">Brand<span class="text-danger">*</span></label>
                                <select class="js-example-basic-single" name="brand">
                                    <option value="">-- Select Brand--</option>
                                    @php
                                        $brands = App\Models\General\Brand::all();
                                    @endphp
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div id="size" style="display: none;" class="col-lg-3 col-sm-6 col-12 mt-1">
                                <label class="col-form-label">Select All Available Sizes</label>
                                <div class="form-group">
                                    <select class="js-example-basic-single form-control tagging" multiple="multiple" name="size[]">
                                        <option value="">Choose all that Apply</option>
                                        <option value="SM">SM</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                        <option value="XXXL">XXXL</option>
                                    </select>
                                </div>
                            </div>

                            <div id="color" style="display: none;" class="col-lg-3 col-sm-6 col-12 mt-1">
                                <label class="col-form-label">Choose Available Colors.</label>
                                <div class="form-group">
                                    <select class="select2 form-control tagging" multiple="multiple" name="color[]">
                                        <option value="">Choose all that Apply</option>
                                        <option value="Black">Black</option>
                                        <option value="White">White</option>
                                        <option value="Red">Red</option>
                                        <option value="Silver">Silver</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-3 col-sm-6 col-12 mt-1">
                            <div class="form-group">
                                <label class="mb-3">Regular Price<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">GHS.</span>
                                    <input id="reg_price" type="text" name="regular_price" value="0"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12 mt-1">
                            <div class="form-group">
                                <label class="mb-3">Sales Price<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">GHS.</span>
                                    <input id="sale_price" type="text" name="sales_price" value="0"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="col-form-label">Discount(%)</label>
                                <input id="discount" readonly type="text" name="discount" value="0"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="col-form-label">Quantity<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-form-label">Description<span class="text-danger">*</span></label>
                                <textarea id="description" class="form-control" rows="6" name="description"></textarea>
                            </div>
                        </div>


                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label class="col-form-label">Status<span class="text-danger">*</span></label>
                                <select class="js-example-basic-single" name="status">
                                    <option value="active">Choose Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <label>Product Image(1)
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" name="image_one"
                                            class="custom-file-container__custom-file__custom-file-input"
                                            accept="image/*" />
                                        {{-- <input type="file" name="image_one" /> --}}
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="col-form-label"> Product Image(1)<span
                                            class="text-danger">*</span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_one" id="image_one" class="form-control"
                                            onchange="showImageHereFunc('image_one','showImage_one');" />
                                    </div>
                                </div>
                                <div class="row" id="showImage_one">
                                </div> --}}
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-file-container" data-upload-id="mySecondImage">
                                    <label>Product Image(2)
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" name="image_two"
                                            class="custom-file-container__custom-file__custom-file-input"
                                            accept="image/*" />
                                        {{-- <input type="file" name="image_two" /> --}}
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="col-form-label"> Product Image(2)<span class=""></span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_two" id="image_two" class="form-control"
                                            onchange="showImageHereFunc('image_two','showImage_two');" />
                                    </div>
                                </div>
                                <div class="row" id="showImage_two">
                                </div> --}}
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-file-container" data-upload-id="myThirdImage">
                                    <label>Product Image(3)
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" name="image_three"
                                            class="custom-file-container__custom-file__custom-file-input"
                                            accept="image/*" />
                                        {{-- <input type="file" name="image_three" /> --}}
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="col-form-label"> Product Image(3)<span class=""></span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_three" id="image_three" class="form-control"
                                            onchange="showImageHereFunc('image_three','showImage_three');" />
                                    </div>
                                </div>
                                <div class="row" id="showImage_three">
                                </div> --}}
                            </div>
                            <div class="col-lg-6">
                                <div class="custom-file-container" data-upload-id="myFourthImage">
                                    <label>Product Image(4)
                                        <a href="javascript:void(0)" class="custom-file-container__image-clear"
                                            title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" name="image_four"
                                            class="custom-file-container__custom-file__custom-file-input"
                                            accept="image/*" />
                                        {{-- <input type="file" name="image_four" /> --}}
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                                {{-- <div class="form-group">
                                    <label class="col-form-label"> Product Image(4)<span class=""></span></label>
                                    <div class="form-group">
                                        <input type="file" name="image_four" id="image_four" class="form-control"
                                            onchange="showImageHereFunc('image_four','showImage_four');" />
                                    </div>
                                </div>
                                <div class="row" id="showImage_four">
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Add New Product</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        var uploadIdList = ['myFirstImage', 'mySecondImage', 'myThirdImage', 'myFourthImage'];
        uploadIdList.forEach(function(id) {
            var upload = new FileUploadWithPreview(id);
        });
    });
</script>
<script>
   $(document).ready(function () {
    $(".js-example-basic-single").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        createTag: function(params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            };
        }
    });
});

    $(document).ready(function() {
        const subcategoryDropdown = $('#subCategory');
        const sizeInput = $("#size");
        const colorInput = $("#color");

        subcategoryDropdown.prop('disabled', true);
        // Clear existing subcategory options
        subcategoryDropdown.empty().append('<option value="">Choose Sub Category</option>');

        $('#category').change(function() {
            const categoryId = $(this).val();
            console.log("category_id", categoryId);

            // Fetch subcategories using Ajax
            if (categoryId) {
                subcategoryDropdown.prop('disabled', false);
                subcategoryDropdown.empty().append('<option value="">Choose Sub Category</option>');

                // get category name
                $.ajax({
                    url: '/get-category/' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        if (data) {
                            console.log("category", data[0]);
                            if (data[0] === "Fashion and Clothing" || data.category_name ===
                                "Fashion & Clothing") {
                                sizeInput.css("display", "block");
                                colorInput.css("display", "block");
                            }else{
                                sizeInput.css("display", "none");
                                colorInput.css("display", "none");
                            }
                        }
                    }
                });

                $.ajax({
                    url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        console.log("subcategories", data);
                        if (data.length > 0) {
                            $.each(data, function(key, value) {
                                $('#subCategory').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            } else {
                subcategoryDropdown.prop('disabled', true);
            }
        });

        function updateDiscount() {
            const regPrice = parseFloat($('#reg_price').val());
            const salePrice = parseFloat($('#sale_price').val());

            // Check if sale price is greater than regular price
            if (salePrice > regPrice) {
                alert("Sales price cannot be greater than regular price!");
                $('#sale_price').val(regPrice);
                salePrice = regPrice;
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

    function showImageHereFunc(id, showImage_section) {
        const fileInput = document.getElementById(id);
        const files = fileInput.files;

        if (files.length > 0) {
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
            .create(document.querySelector('#description'), {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'alignment',
                        '|',
                        'undo',
                        'redo'
                    ]
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
