@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Add Sub Category</h4>
                <h6>Create New Product Sub-Category</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.subcategory.store') }}" enctype="multipart/form-data" method="POST">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @csrf
                    <div class="row">

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Parent Category</label>
                                <select class="form-control" name="category_id">
                                    <option>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ \Illuminate\Support\Str::title($category->category_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub-Category Name</label>
                                <input type="text" name="name" />
                            </div>
                        </div>

                        {{-- <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Category Code</label>
                            <input type="text" />
                        </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Add New Sub-Category</button>
                            <a href="{{ route('admin.subcategories') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
