@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product List</h4>
                <h6>Manage your products</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.product.add') }}" class="btn btn-added"><img
                        src="{{ asset('admin/assets/img/icons/plus.svg') }}" alt="img" class="me-1" />Add New
                    Product</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{ asset('admin/assets/img/icons/filter.svg') }}" alt="img" />
                                <span><img src="{{ asset('admin/assets/img/icons/closes.svg') }}" alt="img" /></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="{{ asset('admin/assets/img/icons/search-white.svg') }}"
                                    alt="img" /></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{ asset('admin/assets/img/icons/pdf.svg') }}" alt="img" /></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{ asset('admin/assets/img/icons/excel.svg') }}" alt="img" /></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="{{ asset('admin/assets/img/icons/printer.svg') }}" alt="img" /></a>
                            </li>
                        </ul>
                    </div>
                </div>



                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all" />
                                        <span class="checkmarks"></span>
                                    </label>
                                </th> --}}
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Sub-Category</th>
                                <th>Brand</th>
                                <th>Regular Price</th>
                                <th>Sales Price</th>
                                <th>Discount(%)</th>
                                <th>Qty</th>
                                <th>Promotion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    {{-- <td>
                                        <label class="checkboxs">
                                            <input type="checkbox" />
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td> --}}
                                    <td class="productimgname">
                                        <a href="{{ route('admin.product.show', ['slug' => $product->slug]) }}"
                                            class="product-img">
                                            <img src="{{ asset('uploads/products/' . $product->photos['image_one']) }}"
                                                alt="{{ $product->name }}" />
                                        </a>
                                        <a
                                            href="{{ route('admin.product.show', ['slug' => $product->slug]) }}">{{ \Illuminate\Support\Str::title(substr($product->name, 0, 10) . '...') }}</a>
                                    </td>
                                    <td>{{ !is_null($product->category_id) ? \Illuminate\Support\Str::title($product->category->category_name) : 'N/A' }}
                                    </td>
                                    <td>{{ !is_null($product->subcategory_id) ? \Illuminate\Support\Str::title($product->subcategory->name) : 'N/A' }}
                                    </td>
                                    <td>{{ !is_null($product->brand_id) ? \Illuminate\Support\Str::title($product->brand->name) : 'N/A' }}
                                    </td>
                                    <td>GHS.{{ $product->regular_price }}</td>
                                    <td>GHS.{{ $product->sales_price }}</td>
                                    <td class="text-center">{{ $product->discount_percentage }}%</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        @php
                                            $promote_value = '';
                                            if ($product->promotion) {
                                                $promote_value = 'un-promote';
                                            } else {
                                                $promote_value = 'promote';
                                            }
                                        @endphp
                                        <a href="{{ route('admin.product.promote', ['uuid' => $product->uuid, 'promo_value' => $promote_value]) }}"
                                            class="btn btn-{{ $promote_value === 'un-promote' ? 'success' : 'danger' }} btn-sm text-white">
                                            {{ $promote_value === 'un-promote' ? 'Remove-Promo' : 'Promote' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="me-3"
                                            href="{{ route('admin.product.show', ['slug' => $product->slug]) }}">
                                            <img src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="img" />
                                        </a>
                                        <a class="me-3"
                                            href="{{ route('admin.product.edit', ['uuid' => $product->uuid]) }}">
                                            <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img" />
                                        </a>
                                        <a class="confirm-text"
                                            href="{{ route('admin.product.remove', ['slug' => $product->slug]) }}">
                                            <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img" />
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
