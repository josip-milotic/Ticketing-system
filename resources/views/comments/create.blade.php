@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('comments.create')}}">Create Comment</a></span>
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
                <h1 class="text-center">Leave a comment</h1>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf

                    <div class="md-form 2">
                        <textarea id="comment"
                                  name="comment"
                                  class="md-textarea md-textarea-auto form-control
                        @error('comment') is-invalid @enderror"
                                  style="resize: none"
                                  rows="4"
                                  cols="50" required></textarea>
                        <label for="comment">Comment</label>

                        @error('comment')
                        <span class="invalid-feedback">{{ $errors->first('comment') }}</span>
                        @enderror
                    </div>

                    <div class="md-form">
                        <select id="ticket_id"
                                class="browser-default custom-select m-2"
                                name="ticket_id" required>
                            <option value="" hidden>Ticket</option>
                            @foreach($tickets as $ticket)
                                <option value="{{$ticket->id}}">{{$ticket->title}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('ticket'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('ticket') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="text-center pt-2">
                        <button class="btn btn-primary text-white " type="submit">Create Comment</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row pt-4">
        </div>
    </div>
@endsection
