@extends('school.layouts.master')
@section('content')
<style>
    .table tr th,
    td {
        border: solid rgb(196, 196, 196) 1px;

    }

    .card-table .card-body .table>thead>tr>th{
        border: solid rgb(196, 196, 196) 1px;
    }
</style>
<div class="page-wrapper">
    <div class="container mt-5">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Slider List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('school') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="Info">
                             <a href="{{ 'addslider' }}" class="btn btn-primary">Add Slider</a>
                        </h3>
                        @if (session('status'))
                        <h5 class="alert alert-success">{{ session('status') }}</h5>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table 
                            class="table border-0 star-student table-hover table-center mb-0 table-striped">
                                <thead class="no-wrap text-center">
                                     <tr>
                                        <th>Sr.No.</th>
                                        <th>Image</th>
                                        <th>Sub Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                     </tr>
                                </thead>
                                <tbody class=" no-wrap text-center">
                                    @foreach ($slider as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <img src="{{ asset('slider/'.$item->upload) }}" width="200px" height="100px" alt="Slider image">
                                        </td>
                                        <td>{{ $item->subtitle }}</td>
                                        <td>
                                            @if ($item->status == '1')
                                                hidden
                                            @else
                                                visible
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ 'editslider/'.$item->id }}"
                                                class="btn btn-sm bg-danger-light me-2"style="background-color: rgb(2, 167, 11) !important; color:white !important;">
                                                <i class="feather-edit"></i></a>
                                                <a href="{{ 'removeslider/'.$item->id }}"
                                                    class="btn btn-sm bg-danger me-2"style=" !important; color:white !important;">
                                                    <i class="feather-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection