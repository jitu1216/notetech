@extends('school.layouts.master')
@section('content')


<style>
    .subject img{
        display: none;
    }

</style>


    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Update Subject</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Update Subject</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('update-subject') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="form-title"><span>Subject Information</span></h5>
                                        </div><div class="col-6">
                                            <h5 class="form-title"><span>Subject Total Marks</span></h5>
                                        </div>
                                         {{-- <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject ID <span class="login-danger">*</span></label> --}}
                                            <input  hidden type="text" name="id" value="{{$data->id }}" class="form-control">
                                        {{-- </div>
                                    </div> --}}
                                    <div class="col-8 col-md-4">
                                        <div class="form-group local-forms">
                                            <label>Subject Name <span class="login-danger">*</span></label>
                                            <input value="{{ $data->subject_name }}" name="subject" type="text" class="form-control @error('subject') is-invalid @enderror">
                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>FA 1<span class="login-danger">*</span></label>
                                            <input value="{{ $data->FA1 }}" name="FA1" type="number" class="form-control @error('FA1') is-invalid @enderror">
                                            @error('FA1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>FA 2 <span class="login-danger">*</span></label>
                                            <input value="{{ $data->FA2 }}" name="FA2" type="number" class="form-control @error('FA2') is-invalid @enderror">
                                            @error('FA2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>SA 1 <span class="login-danger">*</span></label>
                                            <input value="{{ $data->SA1 }}" name="SA1" type="number" class="form-control @error('SA1') is-invalid @enderror">
                                            @error('SA1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>SA 2 <span class="login-danger">*</span></label>
                                            <input value="{{ $data->SA2 }}" name="SA2" type="number" class="form-control @error('SA2') is-invalid @enderror">
                                            @error('SA2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label>Practical <span class="login-danger">*</span></label>
                                            <input value="{{ $data->practicle }}" name="Practical" type="number" class="form-control @error('Practical') is-invalid @enderror">
                                            @error('Practical')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Select Allowed Classes</span></h5>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class P.N.C.</label>
                                            <input name="class13" @if (in_array('P.N.C.',$check))
                                                checked
                                            @endif
                                             value="P.N.C." type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class N.C.</label>
                                            <input name="class14" @if (in_array('N.C.',$check))
                                                checked
                                            @endif
                                             value="N.C." type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class K.G.</label>
                                            <input name="class15" @if (in_array('K.G.',$check))
                                                checked
                                            @endif
                                             value="K.G." type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class L.K.G.</label>
                                            <input name="class16" @if (in_array('L.K.G.',$check))
                                                checked
                                            @endif
                                             value="L.K.G." type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class U.K.G.</label>
                                            <input name="class17" @if (in_array('U.K.G.',$check))
                                                checked
                                            @endif
                                             value="U.K.G." type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class I</label>
                                            <input name="class1" @if (in_array('I',$check))
                                                checked
                                            @endif
                                             value="1" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class II</label>
                                            <input @if (in_array('II',$check))
                                            checked
                                        @endif name="class2" value="2" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class III</label>
                                            <input @if (in_array('III',$check))
                                            checked
                                        @endif name="class3" value="3" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class IV</label>
                                            <input @if (in_array('IV',$check))
                                            checked
                                        @endif name="class4" value="4" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class V</label>
                                            <input @if (in_array('V',$check))
                                            checked
                                        @endif   name="class5" value="5" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>

                                     <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class VI</label>
                                            <input @if (in_array('VI',$check))
                                            checked
                                        @endif  name="class6" value="6" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class VII</label>
                                            <input @if (in_array('VII',$check))
                                            checked
                                        @endif  name="class7" value="7" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class VIII</label>
                                            <input @if (in_array('VIII',$check))
                                            checked
                                        @endif  name="class8" value="8" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class IX</label>
                                            <input @if (in_array('IX',$check))
                                            checked
                                        @endif  name="class9" value="9" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-2 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class X</label>
                                            <input @if (in_array('X',$check))
                                            checked
                                        @endif  name="class10" value="10" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XI (Art)</label>
                                            <input  @if (in_array('XI (Art)',$check))
                                            checked
                                        @endif name="class11" value="XI (Art)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XI (Biology)</label>
                                            <input @if (in_array('XI (Biology)',$check))
                                            checked
                                        @endif name="class12" value="XI (Biology)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XI (Agriculture)</label>
                                            <input @if (in_array('XI (Agriculture)',$check))
                                            checked
                                        @endif name="class18" value="XI (Agriculture)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XI (Mathematics)</label>
                                            <input @if (in_array('XI (Mathematics)',$check))
                                            checked
                                        @endif name="class19" value="XI (Mathematics)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XI (Commerce)</label>
                                            <input @if (in_array('XI (Commerce)',$check))
                                            checked
                                        @endif name="class20" value="XI (Commerce)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XII (Art)</label>
                                            <input @if (in_array('XII (Art)',$check))
                                            checked
                                        @endif name="class21" value="XII (Art)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XII (Biology)</label>
                                            <input @if (in_array('XII (Biology)',$check))
                                            checked
                                        @endif name="class22" value="XII (Biology)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XII (Agriculture)</label>
                                            <input @if (in_array('XII (Agriculture)',$check))
                                            checked
                                        @endif name="class23" value="XII (Agriculture)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XII (Mathematics)</label>
                                            <input @if (in_array('XII (Mathematics)',$check))
                                            checked
                                        @endif name="class24" value="XII (Mathematics)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
                                        </div>
                                    </div>
                                    <div class="col-4 col-sm-2">
                                        <div class="form-group local-forms">
                                            <label style="margin-left: -14px;">Class XII (Commerce)</label>
                                            <input @if (in_array('XII (Commerce)',$check))
                                            checked
                                        @endif name="class25" value="XII (Commerce)" type="checkbox" class="form-check-input" style="font-size: 30px; margin-top:30px;">
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
