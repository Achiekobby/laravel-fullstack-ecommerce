@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Category list</h4>
                <h6>View/Search product Category</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.category.add') }}" class="btn btn-added">
                    <img src="assets/img/icons/plus.svg" class="me-1" alt="img" />Add Category
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="assets/img/icons/filter.svg" alt="img" />
                                <span><img src="assets/img/icons/closes.svg" alt="img" /></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img" /></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="assets/img/icons/pdf.svg" alt="img" /></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="assets/img/icons/excel.svg" alt="img" /></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="assets/img/icons/printer.svg" alt="img" /></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all" />
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Category name</th>
                                <th>Category Code</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox" />
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td class="productimgname">
                                        <a href="javascript:void(0);" class="product-img">
                                            @if (!is_null($category->image))
                                            <img src="{{asset('/uploads/categories/'.$category->image)}}" alt="{{$category->category_name}}" />
                                            @else
                                            <img src="assets/img/product/noimage.png" alt="product" />
                                            @endif
                                        </a>
                                        <a href="javascript:void(0);">{{ $category->category_name }}</a>
                                    </td>
                                    <td>{{ $category->category_code }}</td>
                                    <td>{{ $category->description ? substr($category->description,0,20)."..." : 'N/A' }}</td>
                                    <td>{{ $category->created_by }}</td>
                                    <td>
                                        <a class="me-3" href="{{route('admin.category.edit',['slug'=>$category->slug])}}">
                                            <img src="assets/img/icons/edit.svg" alt="img" />
                                        </a>
                                        <a class="me-3 confirm-text" href="{{route('admin.category.remove',['slug'=>$category->slug])}}">
                                            <img src="assets/img/icons/delete.svg" alt="img" />
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
