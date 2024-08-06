@extends('school.layouts.master')
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
                @if ((Custom::checkProfile(Custom::getUser()->id) == 1))
                <h4 style="color:red; text-align:center; margin:10px;">Please Complete your Profile!</h4>

                @endif
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
                                            <form action="{{ route('updateschooldata') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5 class="form-title student-info">School Information
                                                            <span>
                                                                <a href="{{ route('schoollist') }}"><i
                                                                        class="feather-arrow-left"></i></a>
                                                            </span>
                                                        </h5>
                                                    </div>
                                                    <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>School Name <span class="login-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('school_name') is-invalid @enderror"
                                                                name="school_name" placeholder="Enter School Name"
                                                                value="{{ $data->Name }}">
                                                            @error('school_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Registration No. <span
                                                                    class="login-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('registration') is-invalid @enderror"
                                                                name="registration" placeholder="Enter Registration No"
                                                                value="{{ $data->Registration }}">
                                                            @error('registration')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Administrator Name <span
                                                                    class="login-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('administrator_name') is-invalid @enderror"
                                                                name="administrator_name"
                                                                placeholder="Enter Administrator Name"
                                                                value="{{ $data->Username }}">
                                                            @error('administrator_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Select User Type<span
                                                                    class="login-danger">*</span></label>
                                                            <select
                                                                class="form-control select @error('usertype') is-invalid @enderror"
                                                                name="usertype">
                                                                <option selected disabled>--Please Select User Type--
                                                                </option>
                                                                <option value="Administrator"
                                                                    {{ $data->Usertype == 'Administrator' ? 'selected' : '' }}>
                                                                    Administrator
                                                                </option>
                                                                <option value="Manager"
                                                                    {{ $data->Usertype == 'Manager' ? 'selected' : '' }}>
                                                                    Manager
                                                                </option>
                                                                <option value="Principle"
                                                                    {{ $data->Usertype == 'Principle' ? 'selected' : '' }}>
                                                                    Principle
                                                                </option>
                                                                <option value="Clerk"
                                                                    {{ $data->Usertype == 'Clerk' ? 'selected' : '' }}>
                                                                    Clerk
                                                                </option>
                                                                <option value="Teacher"
                                                                    {{ $data->Usertype == 'Teacher' ? 'selected' : '' }}>
                                                                    Teacher
                                                                </option>
                                                            </select>
                                                            @error('usertype')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>E-Mail <span class="login-danger">*</span></label>
                                                            <input class="form-control @error('email') is-invalid @enderror"
                                                                type="text" name="email"
                                                                placeholder="Enter Email Address"
                                                                value="{{ $data->Email }}">
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Mobile No. <span class="login-danger">*</span></label>
                                                            <input
                                                                class="form-control @error('mobile') is-invalid @enderror"
                                                                type="number" name="mobile"
                                                                placeholder="Enter Mobile Number"
                                                                value="{{ $data->Mobile }}">
                                                            @error('mobile')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>School Address <span
                                                                    class="login-danger">*</span></label>
                                                            <input type="text"
                                                                class="form-control @error('school_address') is-invalid @enderror"
                                                                name="school_address" placeholder="Enter School Address"
                                                                value="{{ $data->Address }}">
                                                            @error('school_address')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Select State<span class="login-danger">*</span></label>
                                                            <select
                                                                class="form-control select @error('state') is-invalid @enderror"
                                                                name="state" id="state">
                                                                <option selected value="{{ $data->State }}">
                                                                    {{ $data->State }} </option>
                                                                @foreach ($state as $value)
                                                                    <option value="{{ $value }}"
                                                                        {{ old('state') == $value ? 'selected' : '' }}>
                                                                        {{ $value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('state')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Select City<span class="login-danger">*</span></label>
                                                            <select
                                                                class="form-control select @error('city') is-invalid @enderror"
                                                                name="city" id="city">


                                                            </select>
                                                            @error('city')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms calendar-icon">
                                                            <label>Start Date <span class="login-danger">*</span></label>
                                                            <input
                                                                class="form-control datetimepicker @error('start_date') is-invalid @enderror"
                                                                name="start_date" type="text" placeholder="DD-MM-YYYY"
                                                                value="{{ $data->Start_Date }}">
                                                            @error('start_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms calendar-icon">
                                                            <label>Expiry Date <span class="login-danger">*</span></label>
                                                            <input
                                                                class="form-control datetimepicker @error('expiry_date') is-invalid @enderror"
                                                                name="expiry_date" type="text"
                                                                placeholder="DD-MM-YYYY"
                                                                value="{{ $data->Expiry_Date }}">
                                                            @error('expiry_date')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div> --}}

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Fees Receipt No<span class="login-danger">*</span></label>
                                                            <input
                                                                class="form-control @error('fees_no') is-invalid @enderror"
                                                                type="text" name="fees_no"
                                                                placeholder="Enter Fees Receipt No to Start from"
                                                                value="{{ $data->fees_no }}">
                                                            @error('fees_no')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Password <span class="login-danger">*</span></label>
                                                            <input
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                type="text" name="password"
                                                                placeholder="Enter Password"
                                                                value="{{ old('password') }}">
                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Select Package<span
                                                                    class="login-danger">*</span></label>
                                                            <select disabled
                                                                class="form-control select @error('package') is-invalid @enderror"
                                                                name="package">
                                                                <option selected disabled>Please Select Package </option>
                                                                <option value="1"
                                                                    {{ $data->Package == '1' ? 'selected' : '' }}>Trial
                                                                </option>
                                                                <option value="2"
                                                                    {{ $data->Package == '2' ? 'selected' : '' }}>Basic
                                                                    Package
                                                                </option>
                                                                <option value="3"
                                                                    {{ $data->Package == '3' ? 'selected' : '' }}>Pro
                                                                    Package
                                                                </option>
                                                                <option value="4"
                                                                    {{ $data->Package == '4' ? 'selected' : '' }}>
                                                                    Advance Package
                                                                </option>
                                                            </select>
                                                            @error('package')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group students-up-files">
                                                            <label>Upload School Logo (100px X 100px)</label>
                                                            <div class="uplod">
                                                                <label
                                                                    class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                                    Choose File <input type="file" name="upload"
                                                                        id="school_logo">
                                                                </label>
                                                                @error('upload')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <img id="preview"
                                                                src="{{ URL::to('images') . '/' . $data->Logo }}"
                                                                alt="Logo" width="80" height="80">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="student-submit">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#school_logo").change(function() {
            readURL(this);
        });

        $(document).ready(function() {


            function getCity() {

                var state = '{{ $data->State }}';
                var oldcity = '{{ $data->City }}';

                $.ajax({
                    type: 'GET',
                    data: {
                        state: state
                    },
                    url: "{{ url('school/state') }}",
                    success: function(data) {
                        var city = $('#city');
                        city.find('option').remove();
                        $.each(data, function(key, value) {

                            if (oldcity == value) {
                                city.append('<option selected value=' + value + '>' + value +
                                    '</option>'); // return empty
                            } else {
                                city.append('<option value=' + value + '>' + value +
                                    '</option>'); // return empty
                            }

                        });
                    }
                });

            }

            $('#state').on('change', function() {
                var state = this.value;
                $.ajax({
                    type: 'GET',
                    data: {
                        state: state
                    },
                    url: "{{ url('school/state') }}",
                    success: function(data) {
                        var city = $('#city');
                        city.find('option').remove();
                        $.each(data, function(key, value) {
                            city.append('<option value=' + value + '>' + value +
                                '</option>'); // return empty
                        });
                    }
                });
            });


            getCity();

        });

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

        @if (Session::has('Warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('Warning') }}");
        @endif
    </script>
@endsection
@endsection
