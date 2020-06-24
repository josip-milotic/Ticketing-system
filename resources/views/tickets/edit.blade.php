@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('tickets.index')}}">Tickets</a></span>
    <span> / </span>
    <span><a href="{{route('tickets.show',$ticket)}}">Ticket {{$ticket->id}}</a></span>
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
                <h1 class="text-center">Edit Ticket {{$ticket->id}}</h1>
            </div>
        </div>
        <div class="row pt-5 ">
            <div class="col-3"></div>
            <!-- Material input -->
            <div class="col-6">
                <form method="POST" action="{{route('tickets.update',$ticket->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="md-form 2">
                        <i class="fas fa-cog prefix"></i>
                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control @error('title') is-danger @enderror"
                               required
                               value="{{$ticket->title}}">
                        <label for="title">Title</label>

                        @error('title')
                        <span class="invalid-feedback">{{$errors->first('title')}}</span>
                        @enderror
                    </div>
                    <div class="md-form">
                        <i class="fas fa-pencil-alt prefix"></i>
                        <textarea id="body"
                                  name="body"
                                  class="md-textarea form-control @error('body') is-danger @enderror"
                                  required
                                  value="{{$ticket->body}}"
                                  rows="4">{{$ticket->body}}</textarea>
                        <label for="body">Body</label>

                        @error('body')
                        <span class="invalid-feedback">{{$errors->first('body')}}</span>
                        @enderror
                    </div>

                    <div class="md-form">
                        <select id="state"
                                class="browser-default custom-select m-2"
                                name="state">
                            <option value="{{$ticket->state->id}}" hidden>{{$ticket->state->state}}</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->state}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('state'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="md-form">
                        <select id="client"
                                class="browser-default custom-select m-2"
                                name="client">
                            <option value="{{$ticket->client->id}}" hidden>{{$ticket->client->name}}</option>
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('client'))
                            <span class="help-block">
                                <strong>{{ $errors->first('client') }}</strong>
                            </span>
                        @endif

                        <div class="md-form">
                            <select id="user"
                                    class="browser-default custom-select m-2"
                                    name="user">
                                    <option value="{{$ticket->user->id}}" hidden>{{$ticket->user->name}}</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                            @endif

                    </div>
                    <div class="text-center pt-2">
                        <button class="btn btn-primary text-white " type="submit">Edit Ticket {{$ticket->id}}</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row pt-4">
        </div>
    </div>

@endsection
