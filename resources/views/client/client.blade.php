@extends('client_layout.app')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        @php
                            $subcategories = \App\Models\General\Subcategory::all();

                            $subcategory_id = null;
                            $category_id = null;
                            $subcategory_women = null;
                            $category_women = null;

                            foreach ($subcategories as $subcategory) {
                                if ($subcategory_id === null && stripos($subcategory->name, 'men') !== false) {
                                    $subcategory_id = $subcategory->id;
                                    $category_id = $subcategory->category_id;
                                }

                                if ($subcategory_women === null && stripos($subcategory->name, 'women') !== false) {
                                    $subcategory_women = $subcategory->id;
                                    $category_women = $subcategory->category_id;
                                }

                                // If both conditions are met, terminate the loop
                                if ($subcategory_id !== null && $subcategory_women !== null) {
                                    break;
                                }
                            }

                        @endphp
                        <div class="carousel-item position-relative active" style="height: 430px">
                            <img class="position-absolute w-100 h-100" src="{{ asset('alt_asset/img/carousel-1.jpg') }}"
                                style="object-fit: cover" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        Men Fashion
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                        Discover the essence of modern masculinity. Elevate your style with our curated
                                        collection of men's fashion essentials. From timeless classics to contemporary
                                        trends, find the perfect pieces to redefine your wardrobe.
                                    </p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="{{ !is_null($category_id) && !is_null($subcategory_id) ? route('home.shop.index', ['category' => $category_id, 'subcategory' => $subcategory_id]) : '#' }}">Shop
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px">
                            <img class="position-absolute w-100 h-100" src="{{ asset('alt_asset/img/carousel-2.jpg') }}"
                                style="object-fit: cover" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        Women Fashion
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                        Lorem rebum magna amet lorem magna
                                        erat diam stet. Sadips duo stet amet
                                        amet ndiam elitr ipsum diam
                                    </p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                    href="{{ !is_null($category_women) && !is_null($subcategory_women) ? route('home.shop.index', ['category' => $category_women, 'subcategory' => $subcategory_women]) : '#' }}">Shop
                                    Now</a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="carousel-item position-relative" style="height: 430px">
                            <img class="position-absolute w-100 h-100" src="{{ asset('alt_asset/img/carousel-3.jpg') }}"
                                style="object-fit: cover" />
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">
                                        Kids Fashion
                                    </h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">
                                        Lorem rebum magna amet lorem magna
                                        erat diam stet. Sadips duo stet amet
                                        amet ndiam elitr ipsum diam
                                    </p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp"
                                        href="#">Shop Now</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px">
                    <img class="img-fluid" src="{{ asset('alt_asset/img/offer-1.jpg') }}" alt="" />
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px">
                    <img class="img-fluid" src="{{ asset('alt_asset/img/offer-2.jpg') }}" alt="" />
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Featured Start -->
    {{-- <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">
                        Quality Product
                    </h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Featured End -->

    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Categories</span>
        </h2>
        <div class="row px-xl-5 pb-3">
            @foreach ($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <a class="text-decoration-none" href="{{ route('home.shop.index', ['category' => $category->id]) }}">
                        <div class="cat-item d-flex align-items-center mb-4">
                            <div class="overflow-hidden" style="width: 100px; height: 100%;">
                                <img class="img-fluid" src="{{ asset('/uploads/categories/' . $category->image) }}"
                                    alt="{{ $category->category_name }}" style="height: 100%; object-fit:contain;" />
                            </div>
                            <div class="flex-fill pl-3">
                                <h6>{{ $category->category_name }}</h6>
                                <small class="text-body">100 Products</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Categories End -->

    <!-- Products Start -->
    {{-- <div class="container-fluid pt-5 pb-3"> --}}
    {{-- <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-5">
            <span class="bg-secondary pr-3">Featured Products</span>
        </h2>
        <div class="row px-xl-5">'
            @foreach ($promoted_products as $item)
                @include('client.blade_helpers.item', ['product' => $item])
            @endforeach

        </div> --}}
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Featured Products</span>
        </h2>
        <div class="row px-xl-5">
            @foreach ($promoted_products as $product)
                @include('client.blade_helpers.item', ['product' => $product])
            @endforeach

        </div>
    </div>
    {{-- </div> --}}
    <!-- Products End -->

    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px">
                    <img class="img-fluid" src="{{ asset('alt_asset/img/offer-1.jpg') }}" alt="" />
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-offer mb-30" style="height: 300px">
                    <img class="img-fluid" src="{{ asset('alt_asset/img/offer-2.jpg') }}" alt="" />
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Recent Products</span>
        </h2>
        <div class="row px-xl-5">
            @foreach ($products as $product)
                @include('client.blade_helpers.item', ['product' => $product])
            @endforeach

        </div>
    </div>
    <!-- Products End -->

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @if (count($brands) !== 0)
                        @foreach ($brands as $brand)
                            <a href="{{ route('home.shop.index', ['brand' => $brand->id]) }}">
                                <div class="bg-light p-4"
                                    style="height: 150px; display:flex; justify-content:center; align-items:center">
                                    <img style="height: 100%; object-fit:contain;"
                                        src="{{ '/uploads/brands/' . $brand->image }}" alt="{{ $brand->name }}" />
                                </div>
                            </a>
                        @endforeach
                    @endif
                    {{-- <div class="bg-light p-4">
                            <img src="img/vendor-1.jpg" alt="" />
                        </div> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->
@endsection
