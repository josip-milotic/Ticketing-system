@extends('layout')

@section('content')

<div class="container pt-5">
    <div class="row">
        <div class="col align-self-center">
            <h1>State (GET/create)</h1>
        </div>
    </div>
    <div class="row pt-5 pl-5">
        <div class="col-3"></div>
            <!-- Material input -->
            <div class="col-6">
                <form method="POST" action="/states">
                    @csrf

                    <div class="md-form 2">
                        <i class="fas fa-cog prefix"></i>
                        <input type="text"
                               id="state"
                               name="state"
                               class="form-control @error('state') is-danger @enderror"
                               required
                               value="{{old('state')}}">
                        <label for="state">State</label>

                        @error('state')
                        <p class="help is-danger">{{$errors->first('state')}}</p>
                        @enderror
                    </div>

                    <button class="btn blue-gradient text-white " type="submit">Store (POST/States)</button>

                </form>
            </div>
        <div class="col-3"></div>
    </div>
    <div class="row pt-4">
        <div class="col-3"></div>
            <div class="col-3 pl-5">
                <a class="text-white" href="/">
                    <button class="btn peach-gradient">Početna</button>
                </a>
            </div>
        <div class="col-3"></div>
    </div>
</div>

@endsection
