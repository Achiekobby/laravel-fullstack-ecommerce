@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Update Category</h4>
                <h6>Update product Category</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.categories') }}" class="btn btn-added">
                    <img src="{{asset('admin/assets/img/icons/eye1.svg')}}" class="me-1" alt="img" />View Categories
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.category.update',['slug'=>$category->slug])}}" enctype="multipart/form-data" method="POST">
                    @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="category_name" value="{{$category->category_name}}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Category Code</label>

                                <input type="text" value="{{$category->category_code}}" name="category_code" readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{$category->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label> Category Image<span class="text-danger">*</span></label>
                                <div class="form-group">
                                    <input id="image" type="file" name="image" class="form-control" onchange="showImageHereFunc('image','prev_showImage')"/>
                                </div>
                            </div>
                            <div id="showImage"></div>
                            <div class="row" id="prev_showImage">
                                @if (!is_null($category->image))
                                    <div class='col-lg-3 col-sm-6 col-12 mb-3'>
                                        <img style='width:100%;height:100px; object-fit:contain; '
                                            class='card-img-top'
                                            src='{{ asset('/uploads/categories/' . $category->image) }}'>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update Category</button>
                            <a href="{{route('admin.categories')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    function showImageHereFunc(id, prev_image_show) {
        const fileInput = document.getElementById(id);
        const files = fileInput.files;

        const prev_image = document.getElementById(prev_image_show);

        if (files.length > 0) {
            const file = files[0];
            const imageSrc = URL.createObjectURL(file);
            prev_image.style.display = "none";

            $(`#showImage`).append(
                "<div class='col-lg-3 col-sm-6 col-12 mb-3'><img style='width:100%;height:100px; object-fit:contain; ' class='card-img-top' src='" +
                imageSrc + "'></div>"
            );
        }
    }
</script>
