@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Student</a></li>
                                <li class="breadcrumb-item active">Add Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('store-student') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Student Information
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Student Name<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('student_name') is-invalid @enderror"
                                                        name="student_name" placeholder="Enter Student Name"
                                                        value="{{ old('student_name') }}" id="student_name">
                                                    @error('student_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Father/Husband Name <span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('father_name') is-invalid @enderror"
                                                        name="father_name" placeholder="Enter Father Name"
                                                        value="{{ old('father_name') }}" id="father_name">
                                                    @error('father_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Mother Name<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('mother_name') is-invalid @enderror"
                                                        name="mother_name" placeholder="Enter Mother Name"
                                                        value="{{ old('mother_name') }}" id="mother_name">
                                                    @error('mother_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Class<span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control select  @error('class') is-invalid @enderror"
                                                        name="class" id="class">
                                                        <option selected disabled>Select Class</option>
                                                        @foreach ($finalarray as $value)
                                                            <option value="{{ $value['id'] }}"
                                                                {{ old('class') == $value['classname'] ? 'selected' : '' }}>
                                                                {{ $value['classname'] }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @error('class')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control select  @error('gender') is-invalid @enderror"
                                                        name="gender" id="gender">
                                                        <option selected disabled>Select Gender</option>
                                                        <option value="Female"
                                                            {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="Male"
                                                            {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="Others"
                                                            {{ old('gender') == 'Others' ? 'selected' : '' }}>
                                                            Others</option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input
                                                        class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror"
                                                        name="date_of_birth" type="text" placeholder="DD-MM-YYYY"
                                                        value="{{ old('date_of_birth') }}" id="dob">
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-4 col-sm-4 justify-content-center">
                                        <div class="col-12 col-sm-4 w-100">
                                            <div
                                                class="form-group students-up-files d-flex justify-content-center align-items-center flex-column">
                                                <img id="preview" src="{{ URL::to('assets/img/image-preview.png') }}"
                                                    alt="Logo" width="125" height="150">
                                                <label>Upload Student Photo</label>
                                                <div class="uplod">
                                                    <label
                                                        class="file-upload image-upbtn mb-0 @error('upload') is-invalid @enderror">
                                                        Choose File <input type="file" name="upload" id="image">
                                                    </label>
                                                    @error('upload')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Religion <span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('religion') is-invalid @enderror"
                                                name="religion">
                                                <option selected disabled>Select Religion</option>
                                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>
                                                    Hindu</option>
                                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>
                                                    Islam
                                                </option>
                                                <option value="Sikh" {{ old('religion') == 'Sikh' ? 'selected' : '' }}>
                                                    Sikh</option>
                                                <option value="Christian"
                                                    {{ old('religion') == 'Christian' ? 'selected' : '' }}>
                                                    Christian</option>
                                                <option value="Buddhist"
                                                    {{ old('religion') == 'Buddhist' ? 'selected' : '' }}>
                                                    Buddhist</option>
                                                <option value="Parsi" {{ old('religion') == 'Parsi' ? 'selected' : '' }}>
                                                    Parsi</option>
                                            </select>
                                            @error('religion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Category<span class="login-danger">*</span></label>
                                            <select class="form-control select  @error('category') is-invalid @enderror"
                                                name="category">
                                                <option selected disabled>Select Category</option>
                                                <option value="General"
                                                    {{ old('category') == 'General' ? 'selected' : 'General' }}>General
                                                </option>
                                                <option value="OBC" {{ old('category') == 'OBC' ? 'selected' : '' }}>
                                                    OBC
                                                </option>
                                                <option value="SC" {{ old('category') == 'SC' ? 'selected' : '' }}>
                                                    SC</option>
                                                <option value="ST" {{ old('category') == 'ST' ? 'selected' : '' }}>
                                                    ST</option>

                                            </select>
                                            @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Caste</label>
                                            <input class="form-control @error('caste') is-invalid @enderror"
                                                type="text" name="caste" placeholder="Enter Caste"
                                                value="{{ old('caste') }}">
                                            @error('caste')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>Address Type<span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select @error('locality_type') is-invalid @enderror"
                                                name="locality_type" id="locality_type">
                                                <option disabled selected>Select Address Type</option>
                                                <option value="Village"
                                                    {{ old('locality_type') == 'Village' ? 'selected' : '' }}>
                                                    Village</option>
                                                <option value="Locality"
                                                    {{ old('locality_type') == 'Locality' ? 'selected' : '' }}>
                                                    Locality</option>
                                            </select>
                                            @error('locality_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Village/Locality</label>
                                            <input class="form-control @error('village') is-invalid @enderror"
                                                type="text" name="village" placeholder="Enter Village"
                                                value="{{ old('village') }}">
                                            @error('village')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>Area Type<span class="login-danger">*</span></label>
                                            <select class="form-control select @error('post_type') is-invalid @enderror"
                                                name="post_type" id="post_type">
                                                <option disabled selected>Select Area Type</option>
                                                <option value="Post"
                                                    {{ old('post_type') == 'Post' ? 'selected' : '' }}>
                                                    Post</option>
                                                <option value="Town"
                                                    {{ old('post_type') == 'Town' ? 'selected' : '' }}>
                                                    Town</option>
                                            </select>
                                            @error('post_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Post/Town</label>
                                            <input class="form-control @error('town') is-invalid @enderror"
                                                type="text" name="town" placeholder="Enter Town"
                                                value="{{ old('town') }}">
                                            @error('town')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Select State<span class="login-danger">*</span></label>
                                            <select class="form-control select @error('state') is-invalid @enderror"
                                                name="state" id="state">
                                                <option selected disabled>Please Select State </option>
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
                                            <select class="form-control select @error('city') is-invalid @enderror"
                                                name="city" id="city">
                                                <option selected disabled>Please Select City </option>

                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Pincode</label>
                                            <input class="form-control @error('pincode') is-invalid @enderror"
                                                type="number" name="pincode" placeholder="Enter Pincode"
                                                value="{{ old('pincode') }}">
                                            @error('pincode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mobile No.</label>
                                            <input class="form-control @error('mobile') is-invalid @enderror"
                                                type="number" name="mobile" placeholder="Enter Mobile No"
                                                value="{{ old('mobile') }}" id="mobile">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email</label>
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                type="text" name="email" placeholder="Enter Email"
                                                value="{{ old('email') }}" id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nationality</label>
                                            <input class="form-control @error('nationality') is-invalid @enderror"
                                                type="text" name="nationality" placeholder="Enter Nationality"
                                                value="{{ old('nationality') }}">
                                            @error('nationality')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Transport Station</label>
                                            <input class="form-control @error('transport') is-invalid @enderror"
                                                type="text" name="transport" placeholder="Enter Transport"
                                                value="{{ old('transport') }}">
                                            @error('transport')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Occupation <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('occupation') is-invalid @enderror"
                                                name="occupation">
                                                <option selected disabled>Please Occupation </option>
                                                <option value="Labour"
                                                    {{ old('occupation') == 'Labour' ? 'selected' : '' }}>
                                                    Labour</option>
                                                <option value="Agriculture"
                                                    {{ old('occupation') == 'Agriculture' ? 'selected' : '' }}>Agriculture
                                                </option>
                                                <option value="Grocery store"
                                                    {{ old('occupation') == 'Grocery store' ? 'selected' : '' }}>
                                                    Grocery store</option>
                                                <option value="Ngo jobs"
                                                    {{ old('occupation') == 'Ngo jobs' ? 'selected' : '' }}>Ngo jobs
                                                </option>
                                                <option value="Government Job"
                                                    {{ old('occupation') == 'Government Job' ? 'selected' : '' }}>
                                                    Government Job
                                                </option>
                                                <option value="Army"
                                                    {{ old('occupation') == 'Army' ? 'selected' : '' }}>Army
                                                </option>
                                                <option value="Teacher"
                                                    {{ old('occupation') == 'Teacher' ? 'selected' : '' }}>Teacher
                                                </option>
                                                <option value="Businessman"
                                                    {{ old('occupation') == 'Businessman' ? 'selected' : '' }}>Businessman
                                                </option>
                                                <option value="Doctor"
                                                    {{ old('occupation') == 'Doctor' ? 'selected' : '' }}>Doctor
                                                </option>
                                                <option value="Painter"
                                                    {{ old('occupation') == 'Painter' ? 'selected' : '' }}>Painter
                                                </option>
                                                <option value="Driver"
                                                    {{ old('occupation') == 'Driver' ? 'selected' : '' }}>Driver
                                                </option>
                                                <option value="Raj Mistri"
                                                    {{ old('occupation') == 'Raj Mistri' ? 'selected' : '' }}>Raj Mistri
                                                </option>
                                                <option value="Carpenter"
                                                    {{ old('occupation') == 'Carpenter' ? 'selected' : '' }}>Carpenter
                                                </option>
                                                <option value="Tailor"
                                                    {{ old('occupation') == 'Tailor' ? 'selected' : '' }}>Tailor
                                                </option>
                                                <option value="Barber"
                                                    {{ old('occupation') == 'Barber' ? 'selected' : '' }}>Barber
                                                </option>
                                                <option value="Hawker"
                                                    {{ old('occupation') == 'Hawker' ? 'selected' : '' }}>Hawker
                                                </option>
                                                <option value="Coaching master"
                                                    {{ old('occupation') == 'Coaching master' ? 'selected' : '' }}>Coaching
                                                    master
                                                </option>
                                                <option value="Gardner"
                                                    {{ old('occupation') == 'Gardner' ? 'selected' : '' }}>Gardner
                                                </option>
                                                <option value="Goldsmith"
                                                    {{ old('occupation') == 'Goldsmith' ? 'selected' : '' }}>Goldsmith
                                                </option>
                                                <option value="Jouralist"
                                                    {{ old('occupation') == 'Jouralist' ? 'selected' : '' }}>Jouralist
                                                </option>
                                                <option value="Sweeper"
                                                    {{ old('occupation') == 'Sweeper' ? 'selected' : '' }}>Sweeper
                                                </option>
                                                <option value="Cook"
                                                    {{ old('occupation') == 'Cook' ? 'selected' : '' }}>Cook
                                                </option>
                                                <option value="Confectioner"
                                                    {{ old('occupation') == 'Confectioner' ? 'selected' : '' }}>
                                                    Confectioner
                                                </option>
                                                <option value="Welding"
                                                    {{ old('occupation') == 'Welding' ? 'selected' : '' }}>Welding
                                                </option>
                                                <option value="Contractor"
                                                    {{ old('occupation') == 'Contractor' ? 'selected' : '' }}>Contractor
                                                </option>
                                                <option value="Electrician"
                                                    {{ old('occupation') == 'Electrician' ? 'selected' : '' }}>Electrician
                                                </option>
                                                <option value="Material Seller"
                                                    {{ old('occupation') == 'Material Seller' ? 'selected' : '' }}>Material
                                                    Seller
                                                </option>
                                                <option value="Private  Job"
                                                    {{ old('occupation') == 'Private  Job' ? 'selected' : '' }}>Private Job
                                                </option>
                                            </select>
                                            @error('occupation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Aadhar Number <span class="login-danger">*</span></label>
                                            <input class="form-control @error('aadhar') is-invalid @enderror"
                                                type="number" name="aadhar" placeholder="Enter Aadhar No"
                                                value="{{ old('aadhar') }}">
                                            @error('aadhar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Last Institute <span class="login-danger">*</span></label>
                                            <input class="form-control @error('institute') is-invalid @enderror"
                                                type="text" name="institute" placeholder="Enter Last Institute Number"
                                                value="{{ old('institute') }}">
                                            @error('institute')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Student Password <span class="login-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="text" name="password" placeholder="Enter Password"
                                                value="{{ old('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 m-4 mt-0 ">
                                        <div class="row" id="subject">
                                            <h5 class="form-title"><span>Select Subjects</span></h5>

                                        </div>
                                    </div>



                                    <div class="col-12">
                                        <button  type="button" class="btn btn-info mt-1" data-bs-toggle="modal"
                                            data-bs-target="#login-modal" id="popup">Submit</button>

                                    </div>
                                </div>
                                <div id="login-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="text-center mt-2 mb-4">
                                                    <div class="auth-logo">
                                                        <a href="index.html" class="logo logo-dark">
                                                            <span class="logo-lg">
                                                                <img src="assets/img/logo.png" alt=""
                                                                    height="42">
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <form action="#" class="px-3">
                                                    <div class="row ">
                                                        <h4 style="text-align: center; color:red; margin-top:-40px;">Please
                                                            Check Details</h4>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Student Name
                                                            </label>
                                                            <h5 class="form-control"
                                                                style="height: 40px; margin-top:-7px;" id="student">
                                                                john@deo.com</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Class
                                                            </label>
                                                            <h5 class="form-control"
                                                                style="height: 40px; margin-top:-7px;" id="stdclass">
                                                                john@deo.com</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Father/Husband
                                                                Name
                                                            </label>
                                                            <h5 class="form-control"
                                                                style="height: 40px; margin-top:-7px;" id="stdfather">
                                                                john@deo.com</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Mother Name
                                                            </label>
                                                            <h5 style="height: 40px; margin-top:-7px;"
                                                                class="form-control" id="stdmother">john@deo.com</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Gender
                                                            </label>
                                                            <h5 style="height: 40px; margin-top:-7px;"
                                                                class="form-control" id="stdgender">Male</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Date of Birth
                                                            </label>
                                                            <h5 style="height: 40px; margin-top:-7px;"
                                                                class="form-control" id="stddob">16/12/1995</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Email
                                                            </label>
                                                            <h5 style="height: 40px; margin-top:-7px;"
                                                                class="form-control" id="stdemail">
                                                                j.k.1612anand@gmail.com</h5>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="emailaddress1" class="form-label">Mobile No.
                                                            </label>
                                                            <h5 style="height: 40px; margin-top:-7px;"
                                                                class="form-control" id="stdmobile">8218159856</h5>
                                                        </div>
                                                        <div class="row m-4">
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="student-submit">
                                                                    <a href="" class="btn btn-primary" id="editbtn">Edit</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <div class="student-submit">
                                                                    <input type="submit" class="btn btn-success"
                                                                        value="Submit">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        $(document).ready(function() {


            $('#popup').on('click', function() {

                var stdname = $('#student_name').val();
                var stdfather = $('#father_name').val();
                var stdmother = $('#mother_name').val();
                var stdgender = $('#gender').val();
                var stddob = $('#dob').val();
                var stdemail = $('#email').val();
                var stdmobile = $('#mobile').val();
                var stdclass = $('#class :selected').text();

                $("#student").text(stdname);
                $('#stdclass').text(stdclass);
                $('#stdfather').text(stdfather);
                $('#stdmother').text(stdmother);
                $('#stdgender').text(stdgender);
                $('#stddob').text(stddob);
                $('#stdemail').text(stdemail);
                $('#stdmobile').text(stdmobile);
                $('#schoolRecord').modal('show');
            });


            $('#editbtn').on('click',function(){
                event.preventDefault();
                $('#login-modal').modal('hide');
            });


            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image").change(function() {
                readURL(this);
            });

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

            $('#class').on('change', function() {
                var schoolclass = this.value;
                $.ajax({
                    type: 'GET',
                    data: {
                        schoolclass: schoolclass
                    },
                    url: "{{ url('school/getschoolsubject') }}",
                    success: function(data) {
                        var subject = $('#subject');
                        subject.find('.mainsubject').remove();
                        $.each(data, function(key, value) {
                            subject.append(
                                '<div class="col-2 col-sm-2 mainsubject"><div class="form-group local-forms"><label style="margin-left: -14px;">' +
                                value.subject_name +
                                '</label><input name="subject' + key + '" value="' +
                                value.id +
                                '" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:15px;"></div></div>'
                            ); // return empty
                        });
                    }
                });
            });
        });
    </script>
@endsection
