@extends('admin_layout.layout')
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>User Management</h4>
                <h6>Update User Details</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('admin.users') }}" class="btn btn-added"><img
                        src="{{ asset('admin/assets/img/icons/eye1.svg') }}" alt="img" />Go Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.user.update',['uuid'=>$admin->uuid]) }}" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        @csrf
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" placeholder="Enter First Name"
                                    value="{{ $admin->first_name }}" />
                            </div>
                            @error('first_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" placeholder="Enter Last Name"
                                    value="{{ $admin->last_name }}" />
                            </div>
                            @error('last_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone_number" value="{{ $admin->phone_number }}" />
                            </div>
                            @error('phone_number')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ $admin->email }}" />
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                    <option value="{{ $admin->role }}">
                                        {{ $admin->role === 'admin' ? 'Admin' : 'Super Admin' }}</option>
                                    @if ($admin->role === 'admin')
                                        <option value="super_admin">Super-Admin</option>
                                    @else
                                        <option value="admin">Admin</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="{{ $admin->status }}">
                                        {{ $admin->status === 'active' ? 'Active' : 'Inactive' }}</option>
                                    @if ($admin->status === 'active')
                                        <option value="inactive">Inactive</option>
                                    @else
                                        <option value="active">Active</option>
                                    @endif
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
                            <button type="submit" class="btn btn-submit me-2">Update User</button>
                            <a href="{{ route('admin.users') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
