@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('roles.index')}}"> Roles</a></span>
@endsection

@section('button')
    @can('admin')
        <a class="text-white d-flex" href="{{route('roles.create')}}">
            <button class="btn btn-primary btn-sm my-0 p">Create Role</button>
        </a>
    @endcan
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>List of Roles</h1>
            </div>
        </div>
        <div>
            @if ($roles->isEmpty())
                <p>There are currently no roles.</p>
            @else
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col" class="text-center">View</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="text-center">{{$role->id}}</td>
                            <td class="text-center">{{$role->role}}</td>
                            <td class="text-center">
                                <a class="text-white text-center" href="{{route('roles.show', $role)}}">
                                    <button type="button" class="btn btn-light-blue btn-sm m-0 text-center">View
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
    <div class="p-2"></div>

@endsection
