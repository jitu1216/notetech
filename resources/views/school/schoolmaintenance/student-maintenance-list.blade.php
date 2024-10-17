@extends('school.layouts.master')
@section('content')

    <style>
        body {
            overflow: scroll !important;
        }

        table {
            background-color: white;
        }
    </style>
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="student-group-form" id="searchlist">
                <h3>Maintenance Student List</h3>
                <form action="{{ route('search-student-maintenance-list') }}" method="get">
                    @csrf
                    <div class="row">
                        <div class=" col-md-5">
                            <div class="form-group">
                                <input @if (!empty($studentsearch)) value="{{ $studentsearch }}" @endif type="text"
                                    class="form-control" name="studentsearch" placeholder="Search Student ...">
                                <input value="{{ $mark }}" type="text" class="form-control" name="searchId"
                                    hidden>
                            </div>

                        </div>
                        <div class=" col-md-4">
                            <div class="form-group">
                                <div class="form-group ">
                                    <select class="form-control select  @error('category') is-invalid @enderror"
                                        name="Class">

                                        <option selected value="">All Class</option>
                                        @if (Custom::getStaffRole() == 'Assistant Teacher')
                                            @if (!empty($class))
                                                @foreach ($finalarray as $value)
                                                    @foreach (Custom::getTeacherClass() as $allot_class)
                                                        @if ($allot_class == $value['id'])
                                                            <option value="{{ $value['id'] }}"
                                                                {{ $value['id'] == $class ? 'selected' : '' }}>
                                                                {{ $value['classname'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                                @foreach ($finalarray as $value)
                                                    @foreach (Custom::getTeacherClass() as $allot_class)
                                                        @if ($allot_class == $value['id'])
                                                            <option value="{{ $value['id'] }}"
                                                                {{ old('Class') == 'I' ? 'selected' : '' }}>
                                                                {{ $value['classname'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        @else
                                            @if (!empty($class))
                                                @foreach ($finalarray as $value)
                                                    <option value="{{ $value['id'] }}"
                                                        {{ $value['id'] == $class ? 'selected' : '' }}>
                                                        {{ $value['classname'] }}
                                                    </option>
                                                @endforeach
                                            @else
                                                @foreach ($finalarray as $value)
                                                    <option value="{{ $value['id'] }}"
                                                        {{ old('Class') == 'I' ? 'selected' : '' }}>
                                                        {{ $value['classname'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="search-student-btn">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table table-card">
                <table class="table">
                    <thead class="text-nowrap table-success">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Student Id</th>
                            <th>Student Roll No.</th>
                            <th>Application No.</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Class</th>
                            <th>Mobile</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-nowrap">
                        @foreach ($studentList as $key => $data)
                            <tr>
                                <td> {{ ++$key }}</td>
                                <td>{{ $data->student_id }}</td>
                                <td>{{ $data->roll_no }}</td>
                                <td>{{ $data->application_no }}</td>
                                <td>{{ $data->student_name }}</td>
                                <td>{{ $data->father_name }}</td>
                                <td>{{ $data->classname }}</td>
                                <td>{{ $data->mobile }}</td>
                                <td>
                                    <a href="{{ route('student-maintenance', $data->id) }}"
                                        class=" btn btn-sm bg-success text-white me-2">
                                        Maintenance
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
