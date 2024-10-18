@extends('school.layouts.master')
@section('content')
    <style>
        .container {
            padding: 20px;
            margin: 0px;
            max-width: 100%;
            width: 100%;
        }
    </style>
    <div class="page-wrapper">
        <div class="container mt-5">
            <div class="page-header">
                <div class="row align-item-center">
                    <div class="col">
                        <h3>Edit Notice</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('notice-for-all-list') }}">Notice List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card common-shadow">
                        <div class="card-header">
                            <h3 class="Info">
                                <a href="{{ route('notice-for-all-list') }}" class="btn btn-primary">
                                    <i class="fas fa-back"></i>Back</a>
                            </h3>
                            @if (session('status'))
                                <h5 class="alert alert-success">{{ session('status') }}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('update-notice-for-all') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <input type="text" name="id" hidden value="{{ $item->id }}">
                                            <div class="col-2 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Notice Date<span class="login-danger">*</span></label>
                                                    <input type="text" name="date" class="datetimepicker form-control  
                                                     @error('date') is-invalid @enderror"
                                                     value="{{ Carbon\Carbon::parse($item->date)->format('d/m/Y')  }}" >
                                                    @error('date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-10 col-sm-8">
                                                <div class="form-group local-forms">
                                                    <label>Notice<span class="login-danger">*</span></label>
                                                    <textarea id="myTextarea" type="text" class="form-control @error('notice_text') is-invalid @enderror"
                                                    name="notice_text"  id=""rows="10">{{ $item->notice_text }}</textarea>
                                                    @error('notice_text')
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror </textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="submit">
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
    </div>
    <script>
        tinymce.init({
            selector: '#myTextarea',
            plugins: 'lists link image table',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | table',
            height: 300
        });
    </script>
@endsection
