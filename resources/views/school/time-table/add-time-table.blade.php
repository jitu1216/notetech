@extends('school.layouts.master')
@section('content')
    <style>
        body {
            overflow: scroll !important;
        }

        table {
            background-color: white;
        }

        .print-header {
            display: none;
            margin-top: -30px;
        }

        .print-header h4 {
            text-align: center;
            margin-top: 10px;
        }

        .school {
            width: 100vw;
            display: flex;
            flex-direction: row;
        }

        .logo-container {
            flex: 2;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .main-container {
            flex: 8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-left: -20px !important;
        }

        .main-container h3 {
            font-weight: 800 !important;
            margin-bottom: -2px;
            color: rgb(219, 0, 0);

        }

        .need{
            border: solid red 1px;
        }

        .main-container h6 {
            margin-bottom: -2px;
            font-weight: 600 !important;
            color: blue;
        }

        .main-container span {
            font-size: 12px;
            color: black;
            margin-right: 10px;
        }

        .normal .form-control {
            border: 1px solid rgb(8, 190, 2);

        }

        .change .form-control {
            border: 1px solid red;
        }

        .std_image img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <div class="page-wrapper">
        <form action="{{ route('save-time-table') }}" method="post">
            @csrf
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <div class="page-sub-header">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h3 class="page-title text-center">
                                Add Time Table
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class=" col-md-3">
                        <div class="form-group">
                            <div class="form-group ">
                                <select name="teacher" class="form-control @error('teacher') is-invalid @enderror">
                                    <option value="" selected> Select Teacher</option>
                                    @foreach ($staffList as $value)
                                        <option
                                            value="{{ $value->id }}"{{ old('teacher') == $value->id ? 'selected' : '' }}>
                                            {{ $value->staff_name }} ({{ $value->staff_code }})</option>
                                    @endforeach
                                </select>
                                @error('teacher')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div id="printcontent">
                    <div class="table table-card">
                        <table class="table">
                            <thead class="table-success text-nowrap">
                                <tr style="">
                                    <th>Period</th>
                                    <th>Time</th>
                                    <th>Class</th>
                                    <th>Subject</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @for ($i = 1; $i <= 10; $i++)
                                    @if ($i == 5)
                                        <tr>
                                            <td colspan="4" class="text-center bg-primary">
                                                <h4>Interval</h4>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><input
                                                    class="form-control {{ $errors->has('time.' . $i) ? 'is-invalid' : '' }} "
                                                    type="text" name="time[{{ $i }}]"
                                                    value="{{ old('time.' . $i) }}" placeholder="Enter Time"></td>
                                            <td class="{{ $errors->has('class.' . $i) ? 'is-invalid' : '' }}"> <select
                                                    class="form-control" name="class[{{ $i }}][]" multiple
                                                    id="classlist_{{ $i }}">

                                                    @foreach ($finalarray as $value)
                                                        <option value="{{ $value['id'] }}"
                                                            {{ collect(old('class.' . $i, []))->contains($value['id']) ? 'selected' : '' }}>
                                                            {{ $value['classname'] }}
                                                        </option>
                                                    @endforeach
                                                </select></td>
                                            <td class="{{ $errors->has('subject.' . $i) ? 'is-invalid' : '' }}">
                                                <select
                                                    class="form-control {{ $errors->has('subject.' . $i) ? 'is-invalid' : '' }}"
                                                    name="subject[{{ $i }}][]" id="subject_{{ $i }}"
                                                    multiple="multiple">

                                                    @foreach ($subject as $value)
                                                        <option value="{{ $value->id }}"
                                                            {{ collect(old('subject.' . $i, []))->contains($value->id) ? 'selected' : '' }}>
                                                            {{ $value->subject_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <input type="number" hidden value="{{ $i }}" name="total">
                                    @endif
                                @endfor
                            </tbody>
                        </table>


                        {{-- @if ($class != null) --}}
                        <div class="row">
                            <div class="col-md-9">
                            </div>
                            <div class="col-md-3 search-student-btn">
                                <button type="submit" class="btn btn-primary w-75 me-4"
                                    style="background-color:rgb(89, 89, 255)" id="subbtn">Submit</button>
                            </div>
                        </div>
                        {{-- @endif --}}

                    </div>
                </div>
        </form>
    </div>

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

        $(document).ready(function() {

            for (let i = 1; i <= 10; i++) {
                if (i != 5) {
                    new MultiSelectTag('classlist_' + i, {
                        rounded: true, // default true
                        shadow: false, // default false
                        placeholder: 'Search', // default Search...
                        tagColor: {
                            textColor: '#red',
                            borderColor: '#92e681',
                            bgColor: '#eaffe6',
                        },
                        onChange: function(values) {
                            console.log(values)
                        }
                    })
                    new MultiSelectTag('subject_' + i, {
                        rounded: true, // default true
                        shadow: false, // default false
                        placeholder: 'Search', // default Search...
                        tagColor: {
                            textColor: '#red',
                            borderColor: '#92e681',
                            bgColor: '#eaffe6',
                        },
                        onChange: function(values) {
                            console.log(values)
                        }
                    })

                }
            }


            $('td.is-invalid').each(function() {
               console.log('Get');
                $(this).find('.mult-select-tag').addClass('need');
            });

        });
    </script>
@endsection
