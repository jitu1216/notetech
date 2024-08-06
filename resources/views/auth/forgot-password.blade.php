@extends('layouts.app')
@section('content')
    <div class="login-right">
        <div class="login-right-wrap">
            <h1>Reset Password</h1>
            <p class="account-subtitle">Let Us Help You</p>

            <form action="{{ route('send-otp') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Enter your registered email address <span class="login-danger">*</span></label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email">
                    <span class="profile-views"><i class="fas fa-envelope"></i></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                @if (empty($check))
                <input type="text" name="form_type" value="0" hidden>
                @else
                <input type="text" name="form_type" value="1" hidden>
                @endif

                <div class="form-group" id="otp" @if (empty($check)) style="display:none;" @endif>
                    <label>Enter OTP <span class="login-danger">*</span></label>
                    <input type="number" class="form-control  @error('otp') is-invalid @enderror"
                        name="otp">
                    <span class="profile-views "></span>
                    @error('otp')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>

                <div class="form-group" id="password" @if (empty($check)) style="display:none;" @endif>
                    <label>Password <span class="login-danger">*</span></label>
                    <input type="password" class="form-control pass-input @error('password') is-invalid @enderror"
                        name="password">
                    <span class="profile-views feather-eye toggle-password"></span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="form-group" id="confirm-password"
                    @if (empty($check)) style="display:none;" @endif>
                    <label>Confirm Password <span class="login-danger">*</span></label>
                    <input type="password" class="form-control pass-input @error('confirm-password') is-invalid @enderror"
                        name="confirm-password">
                    <span class="profile-views feather-eye toggle-password"></span>
                    @error('confirm-password')
                        <span class="invalid-feedback" role="alert">
                            <span>{{ $message }}</span>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Reset My Password</button>
                </div>
                <div class="form-group mb-0">
                    {{-- <button class="btn btn-primary primary-reset btn-block" type="submit">Login</button> --}}
                <a class="btn btn-primary primary-reset btn-block" href="{{ url('login')}}">Login</a>

                </div>
            </form>

        </div>
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
    </script>
@endsection
