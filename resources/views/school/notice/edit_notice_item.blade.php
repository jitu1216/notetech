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
                            <li class="breadcrumb-item"><a href="{{ route('notice_item') }}">Notice List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card common-shadow">
                        <div class="card-header">
                            <h3 class="Info">
                                <a href="{{ route('notice_item') }}" class="btn btn-primary">
                                    <i class="fas fa-back"></i>Back</a>
                            </h3>
                            @if (session('status'))
                                <h5 class="alert alert-success">{{ session('status') }}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('update-notice-item') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <input type="text" name="id" hidden value="{{ $item->id }}">
                                                <div class="form-group local-forms">
                                                    <label>Notice Type<span class="login-danger">*</span></label>
                                                    <select
                                                        class="form-control select  @error('item_type') is-invalid @enderror"
                                                        name="item_type">
                                                        <option selected disabled>Select Notice Type </option>
                                                        <option value="Complaints"
                                                            {{ $item->item_type == 'Complaints' ? 'selected' : '' }}>Compliants</option>
                                                        <option value="Suggestion"
                                                            {{ $item->item_type == 'Suggestion' ? 'selected' : '' }}>
                                                            Suggestion </option>
                                                    </select>
                                                    @error('item_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group local-forms">
                                                    <label>Item<span class="login-danger">*</span></label>
                                                    <textarea type="text"
                                                        class="form-control @error('item_name') is-invalid @enderror"
                                                        name="item_name" placeholder="Enter item"
                                                        value="" id="" cols="30" rows="10">
                                                    @error('item_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror {{ $item->item_name }} </textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="submit">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection
