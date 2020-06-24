@extends('layouts.layout')

@section('linked')
    <span>Clients</span>
@endsection

@section('button')
    <form class="d-flex justify-content-center" action="{{route('clients.searchClients')}}" method="GET">
        <!-- Default input -->
        <input type="search" name="search" placeholder="Search clients" aria-label="Search" class="form-control">
        <button class="btn btn-amber btn-sm my-0 p" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <a class="text-white d-flex" href="{{route('clients.create')}}">
        <button class="btn btn-primary btn-sm my-0 p">Create Client</button>
    </a>
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>List of Clients</h1>
            </div>
        </div>
        <div>
            @if ($clients->isEmpty())
                <p>There are currently no clients.</p>
            @else
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Adress</th>
                        <th scope="col" class="text-center">View</th>
                        <th scope="col" class="text-center">Add ticket</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td class="text-center">{{$client->id}}</td>
                            <td class="text-center">{{$client->name}}</td>
                            <td class="text-center">{{$client->email}}</td>
                            <td class="text-center">{{$client->adress}}</td>
                            <td class="text-center">
                                <a class="text-white" href="{{route('clients.show',$client)}}">
                                    <button type="button" class="btn btn-light-blue darken-1 btn-sm m-0">View</button>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-white" href="{{route('tickets.create2',$client)}}">
                                    <button type="button" class="btn btn-light-green btn-sm m-0">Add</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $clients->render() }}
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
