@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('clients.create')}}">Create Client</a></span>
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
        <h1 class="text-center">Create Client</h1>
    </div>
    </div>
    <div class="row pt-5">
        <div class="col-3"></div>
            <!-- Material input -->
            <div class="col-6">
                <form method="POST" action="{{route('clients.store')}}">
                    @csrf

                    <div class="md-form 2">
                        <i class="fas fa-cog prefix"></i>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               required
                               value="{{old('name')}}">
                        <label for="name">Name</label>

                        @error('name')
                        <span class="invalid-feedback">{{$errors->first('name')}}</span>
                        @enderror

                    </div>
                    <div class="md-form 2">
                        <i class="fas fa-at prefix"></i>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               required
                               value="{{old('email')}}"
                               autocomplete="email" autofocus>
                        <label for="email">Email</label>

                        @error('email')
                        <span class="invalid-feedback">{{$errors->first('email')}}</span>
                        @enderror

                    </div>
                    <div class="md-form 2">
                        <i class="fas fa-address-card prefix"></i>
                        <input type="text"
                               id="adress"
                               name="adress"
                               class="form-control @error('adress') is-invalid @enderror"
                               required
                               value="{{old('adress')}}">
                        <label for="adress">Adress</label>

                        @error('adress')
                        <span class="invalid-feedback">{{$errors->first('adress')}}</span>
                        @enderror

                    </div>
                    <div class="text-center pt-2">
                    <button class="btn btn-primary text-white text-center" type="submit">Create Client</button>
                    </div>
                </form>
            </div>
        <div class="col-3"></div>
    </div>
    <div class="row pt-4">

    </div>
</div>

@endsection
