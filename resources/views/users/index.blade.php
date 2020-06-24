@extends('layouts.layout')

@section('linked')
    <span>Users</span>
@endsection

@section('button')
    <form class="d-flex justify-content-center" action="{{route('users.searchUsers')}}" method="GET">
        <!-- Default input -->
        <input type="search" placeholder="Search users" name="search" aria-label="Search" class="form-control">
        <button class="btn btn-amber btn-sm my-0 p" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
    <a class="text-white d-flex" href="{{route('users.create')}}">
        <button class="btn btn-primary btn-sm my-0 p">Create User</button>
    </a>
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>List of Users</h1>
            </div>
        </div>
        <div>
            @if ($users->isEmpty())
                <p>There are currently no users.</p>
            @else
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">User ID</th>
                        <th scope="col" class="text-center">Username</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ $user->username }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">
                                <a class="text-white" href="{{ route('users.show', $user->id) }}">
                                    <button type="button" class="btn btn-light-blue btn-sm m-0">View</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$users->render()}}
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
