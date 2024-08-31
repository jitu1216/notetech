@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Update Students</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Student</a></li>
                                <li class="breadcrumb-item active">Update Students</li>
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
                            <form action="{{ route('update-student') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Student Information
                                            <span>
                                                <a id="printbtn" href="{{ route('printstd', $student->id) }}"
                                                    class=" btn btn-success" style="margin-left:20px;">Print</a>

                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-8 col-md-8 col-sm-8">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Student Name<span class="login-danger">*</span></label>
                                                    <input type="text" name="id" hidden value="{{ $student->id }}">
                                                    <input type="text"
                                                        class="form-control @error('student_name') is-invalid @enderror"
                                                        name="student_name" placeholder="Enter Student Name"
                                                        value="{{ $student->student_name }}" id="student_name">
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
                                                        value="{{ $student->father_name }}" id="father_name">
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
                                                        value="{{ $student->mother_name }}" id="mother_name">
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
                                                                {{ $student->class_id == $value['id'] ? 'selected' : '' }}>
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
                                                            {{ $student->gender == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="Male"
                                                            {{ $student->gender == 'Male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="Others"
                                                            {{ $student->gender == 'Others' ? 'selected' : '' }}>
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
                                                        value="{{ $student->dob }}" id="dob">
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
                                                <img id="preview"
                                                    src="{{ URL::to('student-photos') . '/' . $student->image }}"
                                                    alt="Logo" width="120" height="150">
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
                                                <option value="Hindu"
                                                    {{ $student->religion == 'Hindu' ? 'selected' : '' }}>
                                                    Hindu</option>
                                                <option value="Islam"
                                                    {{ $student->religion == 'Islam' ? 'selected' : '' }}>
                                                    Islam
                                                </option>
                                                <option value="Sikh"
                                                    {{ $student->religion == 'Sikh' ? 'selected' : '' }}>
                                                    Sikh</option>
                                                <option value="Christian"
                                                    {{ $student->religion == 'Christian' ? 'selected' : '' }}>
                                                    Christian</option>
                                                <option value="Buddhist"
                                                    {{ $student->religion == 'Buddhist' ? 'selected' : '' }}>
                                                    Buddhist</option>
                                                <option value="Parsi"
                                                    {{ $student->religion == 'Parsi' ? 'selected' : '' }}>
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
                                                    {{ $student->category == 'General' ? 'selected' : 'General' }}>General
                                                </option>
                                                <option value="OBC"
                                                    {{ $student->category == 'OBC' ? 'selected' : '' }}>
                                                    OBC
                                                </option>
                                                <option value="SC" {{ $student->category == 'SC' ? 'selected' : '' }}>
                                                    SC</option>
                                                <option value="ST" {{ $student->category == 'ST' ? 'selected' : '' }}>
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
                                                value="{{ $student->caste }}">
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
                                                    {{ $student->locality_type == 'Village' ? 'selected' : '' }}>
                                                    Village</option>
                                                <option value="Locality"
                                                    {{ $student->locality_type == 'Locality' ? 'selected' : '' }}>
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
                                                value="{{ $student->village }}">
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
                                                    {{ $student->post_type == 'Post' ? 'selected' : '' }}>
                                                    Post</option>
                                                <option value="Town"
                                                    {{ $student->post_type == 'Town' ? 'selected' : '' }}>
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
                                                value="{{ $student->town }}">
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
                                                        {{ $student->state == $value ? 'selected' : '' }}>
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
                                                value="{{ $student->pincode }}">
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
                                                type="number" name="mobile" placeholder="Enter Pincode"
                                                value="{{ $student->mobile }}" id="mobile">
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
                                                value="{{ $student->email }}" id="email">
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
                                                value="{{ $student->nationality }}">
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
                                                value="{{ $student->transport }}">
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
                                                    {{ $student->father_occupation == 'Labour' ? 'selected' : '' }}>
                                                    Labour</option>
                                                <option value="Agriculture"
                                                    {{ $student->father_occupation == 'Agriculture' ? 'selected' : '' }}>
                                                    Agriculture
                                                </option>
                                                <option value="Grocery store"
                                                    {{ $student->father_occupation == 'Grocery store' ? 'selected' : '' }}>
                                                    Grocery store</option>
                                                <option value="Ngo jobs"
                                                    {{ $student->father_occupation == 'Ngo jobs' ? 'selected' : '' }}>Ngo
                                                    jobs
                                                </option>
                                                <option value="Government Job"
                                                    {{ $student->father_occupation == 'Government Job' ? 'selected' : '' }}>
                                                    Government Job
                                                </option>
                                                <option value="Army"
                                                    {{ $student->father_occupation == 'Army' ? 'selected' : '' }}>Army
                                                </option>
                                                <option value="Teacher"
                                                    {{ $student->father_occupation == 'Teacher' ? 'selected' : '' }}>
                                                    Teacher
                                                </option>
                                                <option value="Businessman"
                                                    {{ $student->father_occupation == 'Businessman' ? 'selected' : '' }}>
                                                    Businessman
                                                </option>
                                                <option value="Doctor"
                                                    {{ $student->father_occupation == 'Doctor' ? 'selected' : '' }}>Doctor
                                                </option>
                                                <option value="Painter"
                                                    {{ $student->father_occupation == 'Painter' ? 'selected' : '' }}>
                                                    Painter
                                                </option>
                                                <option value="Driver"
                                                    {{ $student->father_occupation == 'Driver' ? 'selected' : '' }}>Driver
                                                </option>
                                                <option value="Raj Mistri"
                                                    {{ $student->father_occupation == 'Raj Mistri' ? 'selected' : '' }}>Raj
                                                    Mistri
                                                </option>
                                                <option value="Carpenter"
                                                    {{ $student->father_occupation == 'Carpenter' ? 'selected' : '' }}>
                                                    Carpenter
                                                </option>
                                                <option value="Tailor"
                                                    {{ $student->father_occupation == 'Tailor' ? 'selected' : '' }}>Tailor
                                                </option>
                                                <option value="Barber"
                                                    {{ $student->father_occupation == 'Barber' ? 'selected' : '' }}>Barber
                                                </option>
                                                <option value="Hawker"
                                                    {{ $student->father_occupation == 'Hawker' ? 'selected' : '' }}>Hawker
                                                </option>
                                                <option value="Coaching master"
                                                    {{ $student->father_occupation == 'Coaching master' ? 'selected' : '' }}>
                                                    Coaching
                                                    master
                                                </option>
                                                <option value="Gardner"
                                                    {{ $student->father_occupation == 'Gardner' ? 'selected' : '' }}>
                                                    Gardner
                                                </option>
                                                <option value="Goldsmith"
                                                    {{ $student->father_occupation == 'Goldsmith' ? 'selected' : '' }}>
                                                    Goldsmith
                                                </option>
                                                <option value="Jouralist"
                                                    {{ $student->father_occupation == 'Jouralist' ? 'selected' : '' }}>
                                                    Jouralist
                                                </option>
                                                <option value="Sweeper"
                                                    {{ $student->father_occupation == 'Sweeper' ? 'selected' : '' }}>
                                                    Sweeper
                                                </option>
                                                <option value="Cook"
                                                    {{ $student->father_occupation == 'Cook' ? 'selected' : '' }}>Cook
                                                </option>
                                                <option value="Confectioner"
                                                    {{ $student->father_occupation == 'Confectioner' ? 'selected' : '' }}>
                                                    Confectioner
                                                </option>
                                                <option value="Welding"
                                                    {{ $student->father_occupation == 'Welding' ? 'selected' : '' }}>
                                                    Welding
                                                </option>
                                                <option value="Contractor"
                                                    {{ $student->father_occupation == 'Contractor' ? 'selected' : '' }}>
                                                    Contractor
                                                </option>
                                                <option value="Electrician"
                                                    {{ $student->father_occupation == 'Electrician' ? 'selected' : '' }}>
                                                    Electrician
                                                </option>
                                                <option value="Material Seller"
                                                    {{ $student->father_occupation == 'Material Seller' ? 'selected' : '' }}>
                                                    Material
                                                    Seller
                                                </option>
                                                <option value="Private  Job"
                                                    {{ $student->father_occupation == 'Private  Job' ? 'selected' : '' }}>
                                                    Private Job
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
                                                value="{{ $student->aadhar_no }}">
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
                                                value="{{ $student->last_institute }}">
                                            @error('institute')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Enter Student Password <span class="login-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="text" name="password" placeholder="Enter Student Password"
                                                value="{{ $student->show_pass }}">
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

                                    <div class="row bg-light pt-3 pb-2 mb-4 m-1 mt-0">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Admission Date <span class="login-danger">*</span></label>
                                                <input
                                                    class="form-control datetimepicker @error('admission_date') is-invalid @enderror"
                                                    name="admission_date" type="text" placeholder="DD-MM-YYYY"
                                                    value="{{ $student->admission_date }}" id="admission_date">
                                                @error('admission_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group ">
                                                <label>S.R. Number<span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('sr_no') is-invalid @enderror"
                                                    name="sr_no" placeholder="Enter S.R. Number"
                                                    value="{{ $student->sr_no }}" id="sr_no">
                                                @error('sr_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group ">
                                                <label>Roll Number<span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('roll_no') is-invalid @enderror"
                                                    name="roll_no" placeholder="Enter Roll Number"
                                                    value="{{ $student->roll_no }}" id="roll_no">
                                                @error('roll_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group ">
                                                <label>Fees Account<span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('fees_account') is-invalid @enderror"
                                                    name="fees_account" placeholder="Enter Fees Account No."
                                                    value="{{ $student->fee_account }}" id="fees_account">
                                                @error('fees_account')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-4 sm-4 mt-4">
                                            <div class="student-submit">
                                                <input
                                                    style="padding:12px; background-color:green; padding-left:80px; padding-right:80px; border:none; color:white; border-radius:25px;"
                                                    type="submit" class="" name="approved"
                                                    value="Approved Student">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 mt-4">
                                            <div class="form-group local-forms">
                                                <label>Rejection Reason<span class="login-danger">*</span></label>
                                                <select class="form-control select  @error('reject') is-invalid @enderror"
                                                    name="reject">
                                                    <option selected disabled>Select Reason</option>
                                                    <option value="Aadhar / Marksheet / T.C Not Found"
                                                        {{ $student->reject_reason == 'Aadhar / Marksheet / T.C Not Found' ? 'selected' : '' }}>
                                                        Aadhar / Marksheet / T.C Not Found
                                                    </option>
                                                    <option value="Affidavit Not Found"
                                                        {{ $student->reject_reason == 'Affidavit Not Found' ? 'selected' : '' }}>
                                                        Affidavit Not Found
                                                    </option>
                                                    <option value="Aadhar Card"
                                                        {{ $student->reject_reason == 'Aadhar Card' ? 'selected' : '' }}>
                                                        Aadhar Card</option>
                                                    <option value="Marksheet Previous Year"
                                                        {{ $student->reject_reason == 'Marksheet Previous Year' ? 'selected' : '' }}>
                                                        Marksheet Previous Year</option>
                                                    <option value="Transfer Certificate"
                                                        {{ $student->reject_reason == 'Transfer Certificate' ? 'selected' : '' }}>
                                                        Transfer Certificate</option>
                                                    <option value="Student Signature"
                                                        {{ $student->reject_reason == 'Student Signature' ? 'selected' : '' }}>
                                                        Student Signature</option>
                                                    <option value="Gaurdian's Signature"
                                                        {{ $student->reject_reason == "Gaurdian's Signature" ? 'selected' : '' }}>
                                                        Gaurdian's Signature</option>
                                                    <option value="Photo Not Added"
                                                        {{ $student->reject_reason == 'Photo Not Added' ? 'selected' : '' }}>
                                                        Photo Not Added</option>
                                                    <option value="Fake Admission"
                                                        {{ $student->reject_reason == 'Fake Admission' ? 'selected' : '' }}>
                                                        Fake Admission</option>

                                                </select>
                                                @error('reject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 sm-4 mt-4">
                                            <div class="student-submit">
                                                <input
                                                    style="padding:12px; background-color:rgb(190, 0, 0); padding-left:80px; padding-right:80px; border:none; color:white; border-radius:25px;"
                                                    type="submit" name="rejectbtn" value="Reject Student">
                                            </div>
                                        </div>
                                        {{-- <button type="button" class="btn btn-info mt-1" data-bs-toggle="modal"
                                                data-bs-target="#login-modal" id="popup">Submit</button> --}}

                                    </div>


                                </div>
                                {{-- <div id="login-modal" class="modal fade" tabindex="-1" role="dialog"
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
                                </div> --}}
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

            function getClass() {
                var schoolclass = $('#class').val();
                var subjects = @json($subject);
                // console.log(subjects);
                $.ajax({
                    type: 'GET',
                    data: {
                        schoolclass: schoolclass
                    },
                    url: "{{ url('school/getschoolsubject') }}",
                    success: function(data) {
                        var myarray = [];
                        var subject = $('#subject');
                        subject.find('.mainsubject').remove();

                        $.each(data, function(key, value) {
                            myarray.push(value.subject_name);
                        });

                        console.log(myarray);

                        $.each(data, function(key, value) {

                            // if (subjects[key] == value.subject_name) {
                            for (var i = 0; i < myarray.length; i++) {
                                if (myarray[i] == subjects[key] ) {
                                    var checked = 'checked'
                                    break;
                                } else {
                                    var checked = ''
                                }
                            }

                            subject.append(
                                '<div class="col-2 col-sm-2 mainsubject"><div class="form-group local-forms"><label style="margin-left: -14px;">' +
                                value.subject_name +
                                '</label><input ' + checked + ' name="subject' + key +
                                '" value="' +
                                value.id +
                                '" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:15px;"></div></div>'
                            );

                            var checked = '';
                            // return empty
                            // } else {
                            //     subject.append(
                            //         '<div class="col-2 col-sm-2 mainsubject"><div class="form-group local-forms"><label style="margin-left: -14px;">' +
                            //         value.subject_name +
                            //         '</label><input name="subject' + key + '" value="' +
                            //         value.id +
                            //         '" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:15px;"></div></div>'
                            //     ); // return empty
                            // }

                        });

                    }
                });
            }

            getClass();

            $('#class').on('change', function() {
                var schoolclass = '{{ $student->state }}';
                getClass();
                // $.ajax({
                //     type: 'GET',
                //     data: {
                //         schoolclass: schoolclass
                //     },
                //     url: "{{ url('school/getschoolsubject') }}",
                //     success: function(data) {
                //         var subject = $('#subject');
                //         subject.find('.mainsubject').remove();
                //         $.each(data, function(key, value) {
                //             subject.append(
                //                 '<div class="col-2 col-sm-1 mainsubject"><div class="form-group local-forms"><label style="margin-left: -14px;">' +
                //                 value.subject_name +
                //                 '</label><input name="subject' + key + '" value="' +
                //                 value.id +
                //                 '" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:15px;"></div></div>'
                //             ); // return empty
                //         });
                //     }
                // });
            });

            function getCity() {

                var state = '{{ $student->state }}';
                var oldcity = '{{ $student->district }}';

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

            getCity();
        });
    </script>
@endsection
