@extends('layouts.app')
@section('content')


    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Note Software Company Test</h1>
            {{-- <p class="account-subtitle">Need an account? <a href="{{ route('register') }}">Sign Up</a></p> --}}
            <h2>Sign in @if ($mark == '1')
                    With
                @endif
            </h2>
            <form action="{{ route('student-login') }}" method="POST" id="login">
                @csrf
                <input type="number" hidden name="mark" value="{{ $mark }}">
                @if ($mark == '2')
                    <div class="form-group">
                        <label>Mobile Number<span class="login-danger">*</span></label>
                        <input type="number" value="{{ old('mobile') }}"
                            class="form-control @error('mobile') is-invalid @enderror" name="mobile">
                        <span class="profile-views"><i class="fas fa-phone-alt"></i></span>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password <span class="login-danger">*</span></label>
                        <input type="password" value="{{ old('password') }}"
                            class="form-control pass-input @error('password') is-invalid @enderror" name="password">
                        <span class="profile-views feather-eye toggle-password"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="forgotpass">
                        <div class="remember-me">
                            {{-- <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                        <input type="checkbox" name="remember_me">
                        <span class="checkmark"></span>
                    </label> --}}
                        </div>
                        {{-- <a href="{{ url('forget-password') }}">Forgot Password?</a> --}}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">Login</button>
                <a class="btn btn-block btn-danger mt-3" href="{{ url('login')}}">Administration Login</a>
                    </div>
                @else
                    <div class="row">
                        <input type="text" hidden id="stdname" name="student_id" value="">
                        @foreach ($students as $value)
                            <div class="col-12 col-md-12 rounded bg-danger m-1 p-3 stdbtn" data-id="{{ $value->id }}">
                                <label class="col-12 d-flex justify-content-center align-items-center">
                                    <span class="text-white mt-2 ms-4 me-4">{{ $value->student_name }}</span><span
                                        class="col-2 fa fa-arrow-right text-white ms-4"></span>
                                </label>

                            </div>
                        @endforeach
                @endif
        </div>

        </form>
        {{-- <div class="login-or">
            <span class="or-line"></span>
            <span class="span-or">or</span>
        </div> --}}
        {{-- <div class="social-login">
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div> --}}
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.stdbtn').on('click', function() {
                var id = $(this).data('id');
                $('#stdname').val(id);
                // alert(id);
                $('#login').submit(); // Submit the form
            });
        });

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
