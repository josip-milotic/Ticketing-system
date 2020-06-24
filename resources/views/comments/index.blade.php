@extends('layouts.layout')

@section('linked')
    <span>Comments</span>
@endsection

@section('button')
    <a class="text-white d-flex" href="{{route('comments.create')}}">
        <button class="btn btn-primary btn-sm my-0 p">Create Comment</button>
    </a>
    <a class="text-white d-flex" href="{{route('home')}}">
        <button class="btn btn-amber btn-sm my-0 p">Home</button>
    </a>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col align-self-center">
                <h1>Comments</h1>
            </div>
        </div>
        @if ($comments->isEmpty())
            <p>There are currently no comments.</p>
        @else
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Comment</th>
                    <th scope="col" class="text-center">User</th>
                    <th scope="col" class="text-center">Ticket</th>
                    <th scope="col" class="text-center">View</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td class="text-center">{{ $comment->id }}</td>
                        <td class="text-center">{{ $comment->comment }}</td>
                        <td class="text-center">{{ $comment->user->name }}</td>
                        <td class="text-center">{{ $comment->ticket->title }}</td>
                        <td class="text-center">
                            <a class="text-white" href="{{ route('comments.show', $comment) }}">
                                <button type="button" class="btn btn-light-blue btn-sm m-0">View</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        {{$comments->render()}}
    </div>
@endsection
