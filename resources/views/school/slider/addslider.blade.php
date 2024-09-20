@extends('school.layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <h5 class="alert alert-success">{{ session('status') }}</h5>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ 'slider' }}" class="btn btn-danger float-left">Back</a>

                        </div>

                        <div class="card-body">
                            <form action="{{ route('saveslider') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group local-from">
                                    <label for="">Title <span class="login-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter text"
                                        id="">
                                </div>
                                <div class="form-group local-from">
                                    <label for="">Sub Title <span class="login-danger">*</span></label>
                                    <input type="text" name="subtitle" class="form-control" placeholder="Enter text"
                                        id="">
                                </div>
                                <div class="form-group local-from">
                                    <label for="">Description <span class="login-danger">*</span></label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>

                                </div>

                                <div class="form-group local-from">
                                    <label for="">Upload Slider Image ( W=1280px X H=520px)<span class="login-danger">*</span></label>
                                    <input type="file" name="upload" class="form-control @error('upload') is-invalid @enderror" placeholder="Enter text"
                                        id="">
                                        @error('upload')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-2 col-sm-2 mainsubject">
                                    <div class="form-group local-forms"><label
                                            style="margin-left: -14px;">Status  0=visiable  1=hidden</label><input name="status" value=""
                                            type="checkbox" class="form-check-input  @error('status') is-invalid @enderror"
                                            style="font-size: 30px; margin-top:15px;" value="0">
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                </div>
                                <div class="form-group local-from">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
