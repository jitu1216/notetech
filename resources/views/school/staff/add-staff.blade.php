@extends('school.layouts.master')
@section('content')
    <style>
        .allot .dropdown-toggle::after {
            font-size: 1.3rem;
            vertical-align: 0rem;
            margin-left: 0.5rem;
        }

        .allot .dropdown {
            padding-top: 0.6rem;
        }

        .power {
            /* margin-top: -13rem !important; */
        }

        @media only screen and (max-width: 900px) {

            .power {
                margin-top: -11rem !important;
            }
        }

        @media only screen and (max-width: 600px) {

            .power {
                margin-top: 0rem !important;
            }

        }
    </style>
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Add Staff</h3>
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
                            <form action="{{ route('store-staff') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Staff Information
                                            <span>
                                                <a href="javascript:;"><i class="feather-more-vertical"></i></a>
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8">
                                        <div class="row">
                                            {{-- <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Center Name<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('center_name') is-invalid @enderror"
                                                        name="center_name" placeholder="Enter Center Name"
                                                        value="{{ old('center_name') }}" id="center_name">
                                                    @error('center_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div> --}}
                                            <div class="col-12 col-sm-12">
                                                <div class="form-group local-forms calendar-icon">
                                                    <label>Application Date <span class="login-danger">*</span></label>
                                                    <input
                                                        class="form-control datetimepicker @error('application_date') is-invalid @enderror"
                                                        name="application_date" type="text" placeholder="DD-MM-YYYY"
                                                        value="{{ old('application_date') }}" id="dob">
                                                    @error('application_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Staff Name<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('staff_name') is-invalid @enderror"
                                                        name="staff_name" placeholder="Enter Staff Name"
                                                        value="{{ old('staff_name') }}" id="staff_name">
                                                    @error('staff_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Staff Code<span class="login-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('staff_code') is-invalid @enderror"
                                                        name="staff_code" placeholder="Enter Staff Code"
                                                        value="{{ old('staff_code') }}" id="staff_code">
                                                    @error('staff_code')
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
                                            {{-- <div class="col-12 col-sm-6">
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
                                            </div> --}}
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
                                                <label>Upload Staff Photo</label>
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
                                    <div class="col-12 col-sm-3">
                                        <div class="form-group local-forms">
                                            <label>Gurdian's Occupation <span class="login-danger">*</span></label>
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

                                    <div class="col-12 col-sm-3">
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
                                    <div class="col-12 col-sm-3">
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

                                    <div class="col-12 col-sm-3">
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
                                                <option value="Village">Village</option>
                                                <option value="Locality">Locality</option>

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
                                            <label>Address</label>
                                            <input class="form-control @error('village') is-invalid @enderror"
                                                type="text" name="village" placeholder="Enter Village/Locality Name"
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
                                            <label>Post Type<span class="login-danger">*</span></label>
                                            <select class="form-control select @error('post_type') is-invalid @enderror"
                                                name="post_type" id="post_type">
                                                <option value="Post">Post</option>
                                                <option value="Town">Town</option>

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
                                                type="text" name="town" placeholder="Enter Post/Town Name"
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
                                                type="number" name="mobile" placeholder="Enter Mobile"
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
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Appointment Date</label>
                                            <input
                                                class="form-control datetimepicker @error('appointment_date') is-invalid @enderror"
                                                type="text" name="appointment_date"
                                                placeholder="Enter Appointment Date"
                                                value="{{ old('appointment_date') }}">
                                            @error('appointment_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Appointment Position <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select @error('appointment_position') is-invalid @enderror"
                                                name="appointment_position" id="appointment_position">
                                                <option selected disabled>Please Select Appointment Position </option>
                                                <option value="Founder"
                                                    {{ old('appointment_position') == 'Founder' ? 'selected' : '' }}>
                                                    Founder</option>
                                                <option value="Director"
                                                    {{ old('appointment_position') == 'Director' ? 'selected' : '' }}>
                                                    Director
                                                </option>
                                                <option value="Chairman"
                                                    {{ old('appointment_position') == 'Chairman' ? 'selected' : '' }}>
                                                    Chairman</option>
                                                <option value="Manager"
                                                    {{ old('appointment_position') == 'Manager' ? 'selected' : '' }}>
                                                    Manager
                                                </option>
                                                <option value="Principle"
                                                    {{ old('appointment_position') == 'Principle' ? 'selected' : '' }}>
                                                    Principle
                                                </option>
                                                <option value="Assistant Teacher"
                                                    {{ old('appointment_position') == 'Assistant Teacher' ? 'selected' : '' }}>
                                                    Assistant Teacher
                                                </option>
                                                <option value="Clerk"
                                                    {{ old('appointment_position') == 'Clerk' ? 'selected' : '' }}>
                                                    Clerk
                                                </option>
                                                <option value="Peon"
                                                    {{ old('appointment_position') == 'Peon' ? 'selected' : '' }}>
                                                    Peon
                                                </option>
                                                <option value="Seurity Gauard"
                                                    {{ old('appointment_position') == 'Seurity Gauard' ? 'selected' : '' }}>
                                                    Seurity Gauard
                                                </option>
                                                <option value="Cleaner"
                                                    {{ old('appointment_position') == 'Cleaner' ? 'selected' : '' }}>
                                                    Cleaner
                                                </option>
                                                <option value="Gardner"
                                                    {{ old('appointment_position') == 'Gardner' ? 'selected' : '' }}>
                                                    Gardner
                                                </option>
                                                <option value="Librarian"
                                                    {{ old('appointment_position') == 'Librarian' ? 'selected' : '' }}>
                                                    Librarian
                                                </option>
                                                <option value="Physical Teacher"
                                                    {{ old('appointment_position') == 'Physical Teacher' ? 'selected' : '' }}>
                                                    Physical Teacher
                                                </option>
                                                <option value="Yoga Teacher"
                                                    {{ old('appointment_position') == 'Yoga Teacher' ? 'selected' : '' }}>
                                                    Yoga Teacher
                                                </option>

                                            </select>
                                            @error('appointment_position')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4" id="teacher_class"
                                        @if (old('appointment_position') != 'Assistant Teacher') style="display: none;" @endif>
                                        <div class="form-group local-forms allot">
                                            <label>Select Class for Teacher <span class="login-danger">*</span></label>
                                            <select name="teacher_class[]" class="form-control select allot_class"
                                                id="allot_class" multiple="multiple" style="width: 100%;">
                                                @foreach ($finalarray as $key => $value)
                                                    <option value="{{ $value['id'] }}"
                                                        {{ old('teacher_class[]') == $value['id'] ? 'selected' : '' }}>
                                                        {{ $value['classname'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Identity Type <span class="login-danger">*</span></label>
                                            <select class="form-control select @error('id_type') is-invalid @enderror"
                                                name="id_type">
                                                <option selected disabled>Please Select Identity Type </option>
                                                <option value="Aadhar Card"
                                                    {{ old('id_type') == 'Aadhar Card' ? 'selected' : '' }}>
                                                    Aadhar Card</option>
                                                <option value="Voter ID Card"
                                                    {{ old('id_type') == 'Voter ID Card' ? 'selected' : '' }}>
                                                    Voter ID Card
                                                </option>
                                                <option value="Narega Card"
                                                    {{ old('id_type') == 'Narega Card' ? 'selected' : '' }}>
                                                    Narega Card</option>
                                                <option value="Pan Card"
                                                    {{ old('id_type') == 'Pan Card' ? 'selected' : '' }}>Pan Card
                                                </option>
                                                <option value="Raton Card"
                                                    {{ old('id_type') == 'Raton Card' ? 'selected' : '' }}>
                                                    Raton Card
                                                </option>
                                                <option value="ID Card (School/College)"
                                                    {{ old('id_type') == 'ID Card (School/College)' ? 'selected' : '' }}>
                                                    ID Card (School/College)
                                                </option>
                                            </select>
                                            @error('id_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Identity Card Number <span class="login-danger">*</span></label>
                                            <input class="form-control @error('identity_no') is-invalid @enderror"
                                                type="number" name="identity_no" placeholder="Enter Identity Card No"
                                                value="{{ old('identity_no') }}">
                                            @error('identity_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Qualification <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select @error('qualification') is-invalid @enderror"
                                                name="qualification">
                                                <option selected disabled>Please Select Qualification </option>
                                                <option value="5th Pass"
                                                    {{ old('qualification') == '5th Pass' ? 'selected' : '' }}>
                                                    5th Pass</option>
                                                <option value="8th Pass"
                                                    {{ old('qualification') == '8th Pass' ? 'selected' : '' }}>8th Pass
                                                </option>
                                                <option value="High School"
                                                    {{ old('qualification') == 'High School' ? 'selected' : '' }}>
                                                    High School</option>
                                                <option value="Intermediate"
                                                    {{ old('qualification') == 'Intermediate' ? 'selected' : '' }}>
                                                    Intermediate
                                                </option>
                                                <option value="B.A"
                                                    {{ old('qualification') == 'B.A' ? 'selected' : '' }}>
                                                    B.A
                                                </option>
                                                <option value="B.Com"
                                                    {{ old('qualification') == 'B.Com' ? 'selected' : '' }}>
                                                    B.Com
                                                </option>
                                                <option value="B.Sc"
                                                    {{ old('qualification') == 'B.Sc' ? 'selected' : '' }}>
                                                    B.Sc
                                                </option>
                                                <option value="M.A"
                                                    {{ old('qualification') == 'M.A' ? 'selected' : '' }}>
                                                    M.A
                                                </option>
                                                <option value="M.Com"
                                                    {{ old('qualification') == 'M.Com' ? 'selected' : '' }}>
                                                    M.Com
                                                </option>
                                            </select>
                                            @error('qualification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Degree Qualification <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select @error('experience_qualification') is-invalid @enderror"
                                                name="experience_qualification">
                                                <option selected disabled>Please Select Degree </option>
                                                <option value="Nill Degree"
                                                {{ old('experience_qualification') == 'Nill Degree' ? 'selected' : '' }}>
                                                Nill Degree</option>

                                                <option value="B.Ed."
                                                    {{ old('experience_qualification') == 'B.Ed.' ? 'selected' : '' }}>
                                                    B.Ed.</option>
                                                <option value="M.Ed."
                                                    {{ old('experience_qualification') == 'M.Ed.' ? 'selected' : '' }}>
                                                    M.Ed.
                                                </option>
                                                <option value="P.Hd."
                                                    {{ old('experience_qualification') == 'P.Hd.' ? 'selected' : '' }}>
                                                    P.Hd.</option>
                                            </select>
                                            @error('experience_qualification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Experience Year <span class="login-danger">*</span></label>
                                            <select
                                                class="form-control select @error('experience_year') is-invalid @enderror"
                                                name="experience_year">
                                                <option selected disabled>Please Select Experience Years </option>
                                                <option value="1 Year"
                                                    {{ old('experience_qualification') == '1 Year' ? 'selected' : '' }}>
                                                    1 Year
                                                </option>
                                                <option value="2 Year"
                                                    {{ old('experience_year') == '2 Year' ? 'selected' : '' }}>
                                                    2 Year
                                                </option>
                                                <option value="3 Year"
                                                    {{ old('experience_year') == '3 Year' ? 'selected' : '' }}>
                                                    3 Year
                                                </option>
                                                <option value="4 Year"
                                                    {{ old('experience_year') == '4 Year' ? 'selected' : '' }}>
                                                    4 Year
                                                </option>
                                                <option value="5 Year"
                                                    {{ old('experience_year') == '5 Year' ? 'selected' : '' }}>
                                                    5 Year
                                                </option>
                                            </select>
                                            @error('experience_year')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-sm-4">
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
                                    </div> --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Password <span class="login-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="text" name="password" placeholder="Enter Password No"
                                                value="{{ old('password') }}">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4 power">
                                        <div class="form-group local-forms" >
                                            <label>Select Staff Power <span class="login-danger"></span></label>
                                            <select name="power[]" class="form-control select power_allocate"
                                                id="test_class" multiple="multiple" style="width: 100%;">
                                                <option value="1">New Admission</option>
                                                <option value="2">Approve Admission</option>
                                                <option value="3">Exam</option>
                                                <option value="4">Fees</option>
                                                <option value="5">T.C</option>
                                                <option value="6">C.C</option>
                                                <option value="7">Libraian</option>
                                                <option value="8">Promote Student</option>
                                                <option value="9">Print</option>
                                                <option value="10">S.R</option>
                                                <option value="11">Staff</option>
                                                <option value="12">All Student List</option>
                                                <option value="13">Fees Deposite</option>
                                                <option value="14">Pending Addmission</option>
                                                <option value="15">Pending Fees</option>
                                                <option value="16">Promote Staff</option>
                                                <option value="17">Attendance Student</option>
                                                <option value="18">Attendance Staff</option>
                                                <option value="19">Test Marks</option>
                                                <option value="20">Results</option>
                                                <option value="21">Add Results</option>
                                                <option value="22">Home Work</option>
                                                <option value="23">Time Table</option>
                                                <option value="24">Absent Report Student</option>
                                                <option value="25">Current Running Fees</option>
                                                <option value="26">Holiday</option>
                                            </select>

                                            {{-- <div class="row">
                                                <div class="col-6 col-md-4 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">New Admission</label>
                                                        <input name="power_1" value="1" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 col-sm-3">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Approve Admission</label>
                                                        <input name="power_2" value="2" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-2 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Exam</label>
                                                        <input name="power_3" value="3" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Fees</label>
                                                        <input name="power_4" value="4" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">T.C</label>
                                                        <input name="power_5" value="5" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">C.C</label>
                                                        <input name="power_6" value="6" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Libraian</label>
                                                        <input name="power_7" value="7" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Promote</label>
                                                        <input name="power_8" value="8" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Print</label>
                                                        <input name="power_9" value="9" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">S.R</label>
                                                        <input name="power_10" value="10" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                                <div class="col-3 col-sm-2">
                                                    <div class="form-group local-forms">
                                                        <label style="margin-left: -14px;">Staff</label>
                                                        <input name="power_11" value="11" type="checkbox"
                                                            class="form-check-input"
                                                            style="font-size: 30px; margin-top:20px;">
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>


                                    </div>
                                    {{-- Upload Certificate --}}
                                    {{-- <div class="col-12 col-sm-4">
                                        <div
                                            class=" form-group students-up-files d-flex justify-content-center align-items-center flex-column">
                                            <img class="border m-0" id="preview_experience_certificate"
                                                src="{{ URL::to('assets/img/image-preview.png') }}" alt="Logo"
                                                width="125" height="150">
                                            <label style="font-size: 13px;">Upload Expirenced Certificate Photo</label>
                                            <div class="uplod">
                                                <label
                                                    class="file-upload image-upbtn mb-0 @error('experience_certificate') is-invalid @enderror">
                                                    Choose File <input type="file" name="experience_certificate"
                                                        id="experience_certificate">
                                                </label>
                                                @error('experience_certificate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-12 col-sm-12">
                                        <div class="student-submit">
                                            <input type="submit" class="btn btn-success " value="Submit">
                                        </div>
                                    </div>

                                    {{-- <div class="col-12">
                                        <button type="button" class="btn btn-info mt-1" data-bs-toggle="modal"
                                            data-bs-target="#login-modal" id="popup">Submit</button>
                                    </div> --}}
                                </div>

                                {{-- Modal PopUp  --}}
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
                                                                    <a href="" class="btn btn-primary"
                                                                        id="editbtn">Edit</a>
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

            $('#allot_class').select2();
            $('.power_allocate').select2();

            $("#appointment_position").change(function() {
                var appoint_position = $('#appointment_position').val();
                if (appoint_position == 'Assistant Teacher') {
                    $('#teacher_class').show();
                } else {
                    $('#teacher_class').hide();
                }
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



            $('#popup').on('click', function() {

                var stdname = $('#student_name').val();
                var stdfather = $('#father_name').val();
                var stdmother = $('#mother_name').val();
                var stdgender = $('#gender').val();
                var stddob = $('#dob').val();
                var stdemail = $('#email').val();
                var stdmobile = $('#mobile').val();
                var stdclass = $('#class').val();

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


            $('#editbtn').on('click', function() {
                event.preventDefault();
                $('#login-modal').modal('hide');
            });

            $("#experience_certificate").change(function() {
                readcertificateURL(this);
            });

            function readcertificateURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview_experience_certificate').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $("#image").change(function() {
                readURL(this);
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
                                '<div class="col-2 col-sm-1 mainsubject"><div class="form-group local-forms"><label style="margin-left: -14px;">' +
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
