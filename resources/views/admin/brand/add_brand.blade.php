@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Brand ADD</h4>
                <h6>Create new Brand</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <input type="text" name="name" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Meta-Keywords</label>
                                <p><small class="text-danger">Keywords must be separated with a comma</small></p>
                                <input class="form-control" name="meta_keywords" />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Meta-Description</label>
                                <textarea class="form-control" name="meta_description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" id="image" class="form-control" onchange="showImagePreview()" />
                                </div>
                                <div id="previewImage"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit Brand</button>
                            <a href="{{ route('admin.brands') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function showImagePreview() {
        const inputField = document.getElementById('image');
        const files = inputField.files;

        if (files.length > 0) {
            let file = files[0];
            let imageSrc = URL.createObjectURL(file);

            $('#previewImage').html(
                "<div class='col-lg-3 col-sm-6 col-12 mb-3'><img style='width:100%;height:100px; object-fit:contain; ' class='card-img-top' src='" +
                imageSrc + "'></div>");
        }
    }
</script>
