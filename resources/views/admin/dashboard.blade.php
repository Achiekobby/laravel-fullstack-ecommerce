@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash1.svg')}}" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            $<span class="counters" data-count="0.00">$0.00</span>
                        </h5>
                        <h6>Total Purchases</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash2.svg')}}" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            $<span class="counters" data-count="0">0</span>
                        </h5>
                        <h6>Total Products</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash3.svg')}}" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            $<span class="counters" data-count="">0</span>
                        </h5>
                        <h6>Total User Accounts</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="{{asset('admin/assets/img/icons/dash4.svg')}}" alt="img" /></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5>
                            $<span class="counters" data-count="0.00">0.00</span>
                        </h5>
                        <h6>Total Returns</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>0</h4>
                        <h5>Customers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>0</h4>
                        <h5>Brands</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>0</h4>
                        <h5>Sales Invoice</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>0</h4>
                        <h5>Completed Sales</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Purchase & Sales
                        </h5>
                        <div class="graph-sets">
                            <ul>
                                <li>
                                    <span>Sales</span>
                                </li>
                                <li>
                                    <span>Purchase</span>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    2024
                                    <img src="{{asset('admin/assets/img/icons/dropdown.svg')}}" alt="img" class="ms-2" />
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2024</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2023</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item">2022</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            Recently Added Products
                        </h4>
                        {{-- <div class="dropdown">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a href="#" class="dropdown-item">Product List</a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">Product Add</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dataview">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Regular-Price</th>
                                        <th>Sales-Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recent_products as $product)
                                    <tr>
                                        <td class="productimgname">
                                            <a href="{{route('admin.product.show',['slug'=>$product->slug])}}" class="product-img">
                                                <img src="{{asset('uploads/products/'.$product->photos["image_one"])}}" alt="{{$product->name}}" />
                                            </a>
                                            <a href="{{route('admin.product.show',['slug'=>$product->slug])}}">{{substr(\Illuminate\Support\Str::title($product->name),0,10)."..."}}</a>
                                        </td>
                                        <td>GHS.{{$product->regular_price}}</td>
                                        <td>GHS.{{$product->sales_price}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-0">
            <div class="card-body">
                <h4 class="card-title">Recent Sales</h4>
                <div class="table-responsive dataview">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Brand Name</th>
                                <th>Category Name</th>
                                <th>Order Amount</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="javascript:void(0);">IT0001</a>
                                </td>
                                <td class="productimgname">
                                    <a class="product-img" href="productlist.html">
                                        <img src="{{asset('admin/assets/img/product/product2.jpg')}}" alt="product" />
                                    </a>
                                    <a href="productlist.html">Orange</a>
                                </td>
                                <td>N/D</td>
                                <td>Fruits</td>
                                <td>GHS. 2000.00</td>
                                <td>12-12-2022</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
