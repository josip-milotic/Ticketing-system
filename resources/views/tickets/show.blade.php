@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('tickets.index')}}">Tickets</a></span><span> / </span>
    <span>Ticket {{$ticket->id}} - {{$ticket->title}}</span>
@endsection

@section('button')
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
                <h1>Ticket {{$ticket->id}}</h1>
            </div>
        </div>
        <div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Title</th>
                    <th scope="col" class="text-center">State</th>
                    <th scope="col" class="text-center">Created at</th>
                    <th scope="col" class="text-center">Updated at</th>
                    <th scope="col" class="text-center">Edit</th>
                    <th scope="col" class="text-center">Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">{{$ticket->title}}</td>
                    <td class="text-center">{{$ticket->state->state}}</td>
                    <td class="text-center">{{$ticket->created_at}}</td>
                    <td class="text-center">{{$ticket->updated_at}}</td>
                    <td class="text-center">
                        @can('update',$ticket)
                            <a class="text-white" href="{{route('tickets.edit',$ticket->id)}}">
                                <button type="button" class="btn btn-light-green btn-sm m-0">Edit</button>
                            </a>
                        @else
                            <a class="text-center">Forbidden</a>
                        @endcan
                    </td>
                    <td class="text-center">
                        @can('delete',$ticket)
                            <form method="POST" action="{{route('tickets.destroy',$ticket->id)}}">
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
            <div class="p-4">
                <div class="card">
                    <h5 class="card-header h5">{{$ticket->title}}</h5>
                    <div class="card-body">
                        <p class="card-text">{{$ticket->body}}</p>
                    </div>
                </div>
                <div class="p-2"></div>
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-md-0">
                        <div class="card">
                            <div class="card-header">
                                Client
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$ticket->client->name}}</h5>
                                <p class="card-text">{{$ticket->client->email}}</p>
                                <p class="card-text">{{$ticket->client->adress}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                User
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$ticket->user->name}}</h5>
                                <p class="card-text">{{$ticket->user->username}} | {{$ticket->user->email}}</p>
                                <p class="card-text">{{$ticket->state->state}} | {{$ticket->created_at}}
                                    | {{$ticket->updated_at}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="pl-4 pr-4">
            <div class="col align-self-center" style="margin-top: 40px">
                <h1>Comments</h1>
            </div>
            <div class="col-sm-8">
                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf

                    <div class="md-form 2 p-0 m-0">
                            <textarea id="comment"
                                      name="comment"
                                      class="md-textarea md-textarea-auto form-control
                            @error('comment') is-danger @enderror"
                                      style="resize: none"
                                      rows="2"
                                      style="width: 100%"></textarea>
                        <label for="comment">Leave a comment</label>

                        @error('comment')
                        <p class="help is-danger">{{ $errors->first('comment') }}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}"/>
                    <input type="hidden" name="user_id" value="{{ $ticket->user_id }}"/>
                    <button class="btn btn-primary text-white " type="submit">Add Comment</button>

                </form>
            </div>
        </div>
        <div class="p-4">
            @foreach ($ticket->comments as $comment)
                <div class="p-2">
                    <div class="card">
                        <div class="card-header">
                            {{ $comment->user->name }}
                            <span style="float: right">
                            {{ $comment->updated_at }}
                        </span>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $comment->comment }}</p>
                            <div>
                                @can('update',$comment)
                                    <form method="POST" action="{{route('comments.destroy', $comment->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="float: right; margin-left: 5px"
                                                class="btn red lighten-1 text-white btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                                @can('delete',$comment)
                                    <form method="GET" action="{{route('comments.edit', $comment->id)}}">
                                        <button type="submit" style="float: right; margin-left: 5px"
                                                class="btn btn-light-green btn-sm">Edit
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-12 p-4">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection
