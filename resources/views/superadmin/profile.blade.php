@extends('superadmin.layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img src="{{ URL::to('assets/img/logo.jpeg') }}" alt="Logo" width="30"
                                        height="30">
                                </a>
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ Session::get('name') }}</h4>
                                <h6 class="text-muted">{{ Session::get('role_name') }}</h6>
                                {{-- <div class="user-Location"><i
                                        class="fas fa-map-marker-alt"></i>{{ Session::get('address') }}</div> --}}
                                {{-- <div class="about-text">Lorem ipsum dolor sit amet.</div> --}}
                            </div>
                            {{-- <div class="col-auto profile-btn">
                                <a href="" class="btn btn-primary">
                                    Edit
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <div class="tab-pane fade show active" id="per_details_tab">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                {{-- <a class="edit-link" data-bs-toggle="modal"
                                                    href="#edit_personal_details"><i
                                                        class="far fa-edit me-1"></i>Edit</a> --}}
                                            </h5>

                                            <div class="col-xl-12 d-flex">
                                                <div class="card flex-fill">

                                                    <div class="card-body">
                                                        <form action="{{ route('updateProfile') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 col-form-label"> Name</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ $data->name}}">
                                                                    @error('name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-lg-3 col-form-label">Email Address</label>
                                                                <div class="col-lg-9">
                                                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ $data->email}}">
                                                                    @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 col-form-label">Phone Number</label>
                                                                <div class="col-lg-9">
                                                                    <input name="phone_number" type="number" class="form-control  @error('phone_number') is-invalid @enderror" value="{{ $data->phone_number}}">
                                                                    @error('phone_number')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 col-form-label">Password</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control  @error('password') is-invalid @enderror" name="password">
                                                                    @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-3 col-form-label">Confirm
                                                                    Password</label>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                                                    @error('password_confirmation')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="text-end">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>


                        <div id="password_tab" class="tab-pane fade">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form>
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control">
                                                </div>
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



@section('script')

<script>
      @if (Session::has('Success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('Success') }}");
        @endif

        @if (Session::has('Error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('Error') }}");
        @endif
</script>
@endsection
@endsection
