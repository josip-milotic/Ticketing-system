@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('users.index')}}">Users</a></span>
    <span> / </span>
    <span><a href="{{route('users.show',$user)}}">User {{$user->id}}</a></span>
    <span> / </span>
    <span>Edit</span>
@endsection

@section('button')
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col align-self-center">
                <h1 class="text-center">Edit User {{$user->id}}</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="md-form 2">
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               required
                               value="{{ $user->name }}">
                        <label for="name">Name</label>

                        @error('name')
                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        @enderror
                    </div>

                    <div class="md-form 2">
                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control @error('username') is-invalid @enderror"
                               required
                               value="{{ $user->username }}">
                        <label for="username">Userame</label>

                        @error('username')
                        <span class="invalid-feedback">{{ $errors->first('username') }}</span>
                        @enderror
                    </div>

                    <div class="md-form 2">
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{$user->email}}"
                               class="form-control @error('email') is-invalid @enderror"
                               required
                               autocomplete="email" autofocus>
                        <label for="email">Email</label>

                        @error('email')
                        <span class="invalid-feedback">{{$errors->first('email')}}</span>
                        @enderror
                    </div>

                    <div class="md-form 2">
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        <label for="password">Password</label>

                        @error('password')
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                        @enderror
                    </div>

                    <div class="md-form 2">
                        <select id="role"
                                class="browser-default custom-select"
                                name="role" required>
                            <option value="{{$user->role->id}}" hidden>{{$user->role->role}}</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('role'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="text-center pt-2">
                        <button class="btn btn-primary text-white " type="submit">Edit User {{$user->id}}</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row pt-4">
        </div>
    </div>
@endsection
