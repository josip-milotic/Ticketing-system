@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('roles.create')}}">Create Role</a></span>
@endsection

@section('button')
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')

    <div class="container p-5">
        <div class="row">
            <div class="col align-self-center">
                <h1 class="text-center">Create Role</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-3"></div>
            <!-- Material input -->
            <div class="col-6">
                <form method="POST" action="{{route('roles.store')}}">
                    @csrf

                    <div class="md-form 2">
                        <i class="fas fa-cog prefix"></i>
                        <input type="text"
                               id="role"
                               name="role"
                               class="form-control @error('role') is-invalid @enderror"
                               required
                               value="{{old('role')}}">
                        <label for="role">Role</label>

                        @error('role')
                        <span class="invalid-feedback">{{$errors->first('role')}}</span>
                        @enderror
                    </div>
                    <div class="text-center pt-2">
                        <button class="btn btn-primary text-white text-center " type="submit">Create Role</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row pt-4 ">
        </div>
    </div>



@endsection
