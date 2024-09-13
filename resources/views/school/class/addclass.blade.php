@extends('school.layouts.master')
@section('content')

    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Class</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Class</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('save-class') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Class Information</span></h5>
                                        </div>
                                        {{-- <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject ID <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div> --}}
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Select Class <span class="login-danger">*</span></label>
                                                <select class="form-control select @error('class') is-invalid @enderror"
                                                    name="class" id="state">
                                                    <option selected disabled>Please Select Class </option>
                                                    <option value="P.N.C." {{ old('state') == 'P.N.C.' ? 'selected' : '' }}>P.N.C.
                                                    </option>
                                                    <option value="N.C." {{ old('state') == 'N.C.' ? 'selected' : '' }}>N.C.
                                                    </option>
                                                    <option value="K.G." {{ old('state') == 'K.G.' ? 'selected' : '' }}>K.G.
                                                    </option>
                                                    <option value="L.K.G." {{ old('state') == 'L.K.G.'  ? 'selected' : '' }}>L.K.G.
                                                    </option>
                                                    <option value="U.K.G." {{ old('state') == 'U.K.G.'  ? 'selected' : '' }}>U.K.G.
                                                    </option>
                                                    <option value="1" {{ old('state') == 1 ? 'selected' : '' }}>I
                                                    </option>
                                                    <option value="2" {{ old('state') == 2 ? 'selected' : '' }}>II
                                                    </option>
                                                    <option value="3" {{ old('state') == 3 ? 'selected' : '' }}>III
                                                    </option>
                                                    <option value="4" {{ old('state') == 4 ? 'selected' : '' }}>IV
                                                    </option>
                                                    <option value="5" {{ old('state') == 5 ? 'selected' : '' }}>V
                                                    </option>
                                                    <option value="6" {{ old('state') == 6 ? 'selected' : '' }}>VI
                                                    </option>
                                                    <option value="7" {{ old('state') == 7 ? 'selected' : '' }}>VII
                                                    </option>
                                                    <option value="8" {{ old('state') == 8 ? 'selected' : '' }}>VIII
                                                    </option>
                                                    <option value="9" {{ old('state') == 9 ? 'selected' : '' }}>IX
                                                    </option>
                                                    <option value="10" {{ old('state') == 10 ? 'selected' : '' }}>X
                                                    </option>
                                                    <option value="XI (Art)" {{ old('state') == 'XI (Art)' ? 'selected' : '' }}>XI (Art)
                                                    </option>
                                                    <option value="XI (Biology)" {{ old('state') == 'XI (Biology)' ? 'selected' : '' }}>XI (Biology)
                                                    </option>
                                                    <option value="XI (Agriculture)" {{ old('state') == 'XI (Agriculture)' ? 'selected' : '' }}>XI (Agriculture)
                                                    </option>
                                                    <option value="XI (Mathematics)" {{ old('state') == 'XI (Mathematics)' ? 'selected' : '' }}>XI (Mathematics)
                                                    </option>
                                                    <option value="XI (Commerce)" {{ old('state') == 'XI (Commerce)' ? 'selected' : '' }}>XI (Commerce)
                                                    </option>
                                                    <option value="XII (Art)" {{ old('state') == 'XII (Art)' ? 'selected' : '' }}>XII (Art)
                                                    </option>
                                                    <option value="XII (Biology)" {{ old('state') == 'XII (Biology)' ? 'selected' : '' }}>XII (Biology)
                                                    </option>
                                                    <option value="XII (Agriculture)" {{ old('state') == 'XII (Agriculture)' ? 'selected' : '' }}>XII (Agriculture)
                                                    </option>
                                                    <option value="XII (Mathematics)" {{ old('state') == 'XII (Mathematics)' ? 'selected' : '' }}>XII (Mathematics)
                                                    </option>
                                                    <option value="XII (Commerce)" {{ old('state') == 'XII (Commerce)' ? 'selected' : '' }}>XII (Commerce)
                                                    </option>

                                                </select>
                                                @error('class')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Session Date <span class="login-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('session') is-invalid @enderror"
                                                    name="session">
                                                @error('session')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
