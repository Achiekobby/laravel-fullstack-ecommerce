@extends('client_layout.app')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home.index')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('home.shop.index')}}">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" name="price_range" id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge badge-primary border font-weight-normal">{{$price_all_count}}</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" name="price_range" id="price-1">
                            <label class="custom-control-label" for="price-1">GHS.0 - GHS.100</label>
                            <span class="badge badge-primary border font-weight-normal">{{$price_one_count}}</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" name="price_range" id="price-2">
                            <label class="custom-control-label" for="price-2">GHS.100 - GHS.200</label>
                            <span class="badge badge-primary border font-weight-normal">{{$price_two_count}}</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" name="price_range" id="price-3">
                            <label class="custom-control-label" for="price-3">GHS.200 - GHS.300</label>
                            <span class="badge badge-primary border font-weight-normal">{{$price_three_count}}</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between mb-3">
                            <input type="radio" class="custom-control-input" name="price_range" id="price-4">
                            <label class="custom-control-label" for="price-4">GHS.300 - GHS.400</label>
                            <span class="badge badge-primary border font-weight-normal">{{$price_four_count}}</span>
                        </div>
                        <div class="custom-control custom-radio d-flex align-items-center justify-content-between">
                            <input type="radio" class="custom-control-input" name="price_range" id="price-5">
                            <label class="custom-control-label" for="price-5">Above GHS.400</label>
                            <span class="badge badge-primary border font-weight-normal">{{$price_five_count}}</span>
                        </div>
                    </form>
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        color</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        size</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            {{-- <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div> --}}
                            {{-- <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    @foreach ($products as $product)
                        @include('client.blade_helpers.item', ['product' => $product])
                    @endforeach
                    <div class="col-12">
                        <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
