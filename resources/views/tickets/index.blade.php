@extends('layouts.layout')

@section('linked')
    <span>Tickets</span>
@endsection

@section('button')
    <form class="d-flex justify-content-center" action="{{route('tickets.filterTickets')}}" method="GET">
        <div class="d-flex justify-content-center closed ml-2">
            <select id="state"
                    class="form-control d-flex justify-content-center closed ml-2"
                    name="filter">
                <option value="" hidden>State</option>
                @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->state}}</option>
                @endforeach
            </select>
            @if ($errors->has('state'))
                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
            @endif
        </div>
        <button class="btn btn-secondary btn-sm my-0 p" type="submit">
            Filter
        </button>
    </form>
    <form class="d-flex justify-content-center" action="{{route('tickets.searchTickets')}}" method="GET">
        <!-- Default input -->
        <input type="search" name="search" placeholder="Search tickets" aria-label="Search" class="form-control">
        <button class="btn btn-amber btn-sm my-0 p" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <a class="text-white d-flex" href="{{route('tickets.create')}}">
        <button class="btn btn-primary btn-sm my-0 p">Create Ticket</button>
    </a>
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>List of Tickets</h1>
            </div>
        </div>
        <div>
            @if ($tickets->isEmpty())
                <p>There are currently no tickets.</p>
            @else
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center">State</th>
                        <th scope="col" class="text-center">Client</th>
                        <th scope="col" class="text-center">User</th>
                        <th scope="col" class="text-center">View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="text-center">{{$ticket->id}}</td>
                            <td class="text-center">{{$ticket->title}}</td>
                            <td class="text-center">{{$ticket->state->state}}</td>
                            <td class="text-center">{{$ticket->client->name}}</td>
                            <td class="text-center">{{$ticket->user->username}}</td>
                            <td class="text-center">
                                <a class="text-white" href="{{route('tickets.show',$ticket->id)}}">
                                    <button type="button" class="btn btn-light-blue btn-sm m-0">View</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$tickets->render()}}
            @endif
        </div>
        <div class="col-sm-12 mt-4">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>


    </div>
@endsection
