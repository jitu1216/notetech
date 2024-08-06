@extends('school.layouts.master')
@section('content')

    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Fees Type</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Fees Type</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('save-fees-type') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Fees Type</span></h5>
                                        </div>
                                        {{-- <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Subject ID <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Fees Type <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="feesType">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Select Class <span class="login-danger">*</span></label>
                                                <select class="form-control select @error('class') is-invalid @enderror"
                                                    name="class" id="state">
                                                    <option selected disabled>Please Select Class </option>
                                                    <option value="1" {{ old('state') == 1 ? 'selected' : '' }}>1
                                                    </option>
                                                    <option value="2" {{ old('state') == 2 ? 'selected' : '' }}>2
                                                    </option>
                                                    <option value="3" {{ old('state') == 3 ? 'selected' : '' }}>3
                                                    </option>
                                                    <option value="4" {{ old('state') == 4 ? 'selected' : '' }}>4
                                                    </option>
                                                    <option value="5" {{ old('state') == 5 ? 'selected' : '' }}>5
                                                    </option>
                                                    <option value="6" {{ old('state') == 6 ? 'selected' : '' }}>6
                                                    </option>
                                                    <option value="7" {{ old('state') == 7 ? 'selected' : '' }}>7
                                                    </option>
                                                    <option value="8" {{ old('state') == 8 ? 'selected' : '' }}>8
                                                    </option>
                                                    <option value="9" {{ old('state') == 9 ? 'selected' : '' }}>9
                                                    </option>
                                                    <option value="10" {{ old('state') == 10 ? 'selected' : '' }}>10
                                                    </option>
                                                    <option value="11" {{ old('state') == 11 ? 'selected' : '' }}>11
                                                    </option>
                                                    <option value="12" {{ old('state') == 12 ? 'selected' : '' }}>12
                                                    </option>
                                                </select>
                                                @error('class')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}

                                        <div class="col-8 col-sm-8">
                                            <div class="form-group local-forms">
                                                <label>Fees Type <span class="login-danger">*</span></label>
                                                <input type="text" hidden name="check" value="{{ $check }}">
                                                <input type="text" hidden name="id"
                                                    @if ($check == 1) value="{{ $feestype->id }}" @endif>
                                                <input type="text"
                                                    class="form-control @error('feesType') is-invalid @enderror"
                                                    name="feesType"
                                                    @if ($check == 1) value="{{ $feestype->fees_name }}" @endif>
                                                @error('feesType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-4 float-right">
                                            <div class="form-group local-forms"><label style="margin-left: -14px;">Individual for every Student</label>
                                                <input @if ($check == 1 && $feestype->global == 1)
                                                checked
                                                 @endif name="global" type="checkbox" class="form-check-input"
                                                    style="font-size: 30px; margin-top:15px;" value="1">
                                            </div>
                                        </div>
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
