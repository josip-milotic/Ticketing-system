@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body justify-content-center">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="md-form form-group row justify-content-center mt-0 mb-0">
                                <div class="col-md-6 mt-2 mb-0">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus
                                           placeholder="{{ __('Name') }}">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="md-form form-group row justify-content-center mt-0 mb-0">
                                <div class="col-md-6 mt-2 mb-0">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" required autocomplete="name" autofocus
                                           placeholder="{{ __('Username') }}">

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="md-form form-group row justify-content-center mt-0 mb-0">
                                <div class="col-md-6 mt-2 mb-0">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email"
                                           placeholder="{{ __('E-Mail Address') }}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="md-form form-group row justify-content-center mt-0 mb-0">
                                <div class="col-md-6 mt-2 mb-0">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="md-form form-group row justify-content-center mt-0 mb-0">
                                <div class="col-md-6 mt-2 mb-0">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password"
                                           placeholder="{{ __('Confirm Password') }}">
                                </div>
                            </div>

                            <input id="role_id" type="text" class="form-control" name="role_id" value="1" required
                                   hidden>

                            <div class="form-group row mb-0 mt-2 justify-content-center">
                                <div class="col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
