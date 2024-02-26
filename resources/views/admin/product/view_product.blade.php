@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Details</h4>
                <h6>Full details of a product</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="bar-code-view">
                            {{-- <img src="{{ asset('admin/assets/img/barcode1.png') }}" alt="barcode" /> --}}
                            <a class="printimg">
                                {{-- <img src="assets/img/icons/printer.svg" alt="print" /> --}}
                            </a>
                        </div>
                        <div class="productdetails">
                            <ul class="product-bar">
                                <li>
                                    <h4>Product</h4>
                                    <h6>{{ $product->name }}</h6>
                                </li>
                                <li>
                                    <h4>Category</h4>
                                    <h6>{{ !is_null($product->category->category_name) ? $product->category->category_name : 'N/A' }}
                                    </h6>
                                </li>
                                <li>
                                    <h4>Sub Category</h4>
                                    <h6>{{ !is_null($product->subcategory->name) ? $product->subcategory->name : 'N/A' }}
                                    </h6>
                                </li>
                                <li>
                                    <h4>Brand</h4>
                                    <h6>{{ !is_null($product->brand) ? $product->brand->name : 'N/A' }}</h6>
                                </li>

                                <li>
                                    <h4>Unique Code</h4>
                                    <h6>{{ $product->uuid }}</h6>
                                </li>

                                <li>
                                    <h4>Quantity</h4>
                                    <h6>{{ $product->quantity }}</h6>
                                </li>

                                <li>
                                    <h4>Discount </h4>
                                    <h6>{{ $product->discount_percentage }}%</h6>
                                </li>
                                <li>
                                    <h4>Regular Price</h4>
                                    <h6>GHS.{{ $product->regular_price }}</h6>
                                </li>
                                <li>
                                    <h4>Sales Price</h4>
                                    <h6>GHS.{{ $product->sales_price }}</h6>
                                </li>
                                <li>
                                    <h4>Status</h4>
                                    <h6>{{ \Illuminate\Support\Str::title($product->status) }}</h6>
                                </li>

                            </ul>
                        </div>
                        <div class="p-2 mt-3">
                            <h4>Description</h4>
                            <hr>
                            <h6>
                                {!! $product->description !!}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="slider-product-details">
                            <div class="owl-carousel owl-theme product-slide">
                                @foreach ($product->photos as $photo)
                                    @php
                                        $image_parts = explode('.', $photo);
                                        $extension = $image_parts[count($image_parts) - 1];
                                    @endphp
                                    <div class="slider-product">
                                        <img src="{{ asset('uploads/products/' . $photo) }}" alt="img" />
                                        <h4>{{ $product->name . '.' . $extension }}</h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
