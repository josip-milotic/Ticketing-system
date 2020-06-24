@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('clients.index')}}">Clients</a></span><span> / </span>
    <span>Client {{$client->id}} - {{$client->name}}</span>
@endsection

@section('button')
    <a class="text-white d-flex" href="{{route('clients.create')}}">
        <button class="btn primary-color btn-sm my-0 p">Create Client</button>
    </a>
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn warning-color-dark btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>Details of Client {{$client->name}}</h1>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Adress</th>
                <th scope="col" class="text-center">Edit</th>
                <th scope="col" class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{$client->name}}</td>
                <td class="text-center">{{$client->email}}</td>
                <td class="text-center">{{$client->adress}}</td>
                <td class="text-center">
                    <a class="text-white" href="{{route('clients.edit',$client)}}">
                        <button type="button" class="btn btn-light-green btn-sm m-0">Edit</button>
                    </a>
                </td>
                <td class="text-center">
                    @can('admin',$client)
                        <form method="POST" action="{{route('clients.destroy',$client)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn red lighten-1 text-white btn-sm m-0">Delete</button>
                        </form>
                    @else
                        <a class="text-center">Forbidden</a>
                    @endcan
                </td>
            </tr>
            </tbody>
        </table>
        <div class="col-sm-12 p-4">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection
