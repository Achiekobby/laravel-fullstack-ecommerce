@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User Management</h4>
                <h6>Add User</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.users') }}" class="btn btn-added"><img
                        src="{{ asset('admin/assets/img/icons/eye.svg') }}" alt="img" />Users</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        @csrf
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" placeholder="Enter First Name" />
                            </div>
                            @error('first_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" placeholder="Enter Last Name" />
                            </div>
                            @error('last_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone_number" />
                            </div>
                            @error('phone_number')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" />
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                    <option>Assign Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super-Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            {{-- <div class="form-group">
                                <label> User Image</label>
                                <div class="image-upload">
                                    <input type="file" />
                                    <div class="image-uploads">
                                        <img src="assets/img/icons/upload.svg" alt="img" />
                                        <h4>
                                            Drag and drop a file to
                                            upload
                                        </h4>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
