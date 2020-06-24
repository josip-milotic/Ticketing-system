@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('users.index')}}">Users</a></span><span> / </span>
    <span>User {{$user->id}} - {{$user->name}}</span>
@endsection

@section('button')
    @can('admin')
        <a class="text-white d-flex" href="{{route('users.create')}}">
            <button class="btn btn-primary btn-sm my-0 p">Create User</button>
        </a>
    @endcan
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>Details of User {{$user->name}}</h1>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Edit</th>
                <th scope="col" class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{$user->id}}</td>
                <td class="text-center">{{$user->name}}</td>
                <td class="text-center">{{$user->username}}</td>
                <td class="text-center">{{$user->email}}</td>
                <td class="text-center">
                    <a class="text-white" href="{{route('users.edit',$user)}}">
                        <button type="button" class="btn btn-light-green btn-sm m-0">Edit</button>
                    </a>
                </td>
                <td class="text-center">
                    @can('admin',$user)
                        <form method="POST" action="{{route('users.destroy',$user)}}">
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
