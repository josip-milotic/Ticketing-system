@extends('layouts.layout')

@section('linked')
    <span><a href="{{route('comments.index')}}">Comments</a></span>
    <span> / </span>
    <span><a href="{{route('comments.show',$comment)}}">Comment {{$comment->id}}</a></span>
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
                <h1 class="text-center">Edit a comment {{$comment->id}}</h1>
            </div>
        </div>
        <div class="row pt-5 pl-5">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="POST" action="{{ route('comments.update', $comment) }}">
                    @csrf
                    @method('PUT')

                    <div class="md-form 2">
                    <textarea id="comment"
                              name="comment"
                              class="md-textarea md-textarea-auto form-control
                    @error('comment') is-invalid @enderror"
                              style="resize: none"
                              rows="4"
                              cols="50" required>{{ $comment->comment }}</textarea>
                        <label for="comment">Comment</label>

                        @error('comment')
                        <span class="invalid-feedback">{{ $errors->first('comment') }}</span>
                        @enderror
                    </div>
                    <div class="text-center pt-2">
                        <button class="btn btn-primary text-white " type="submit">Edit Comment</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row pt-4">
        </div>
    </div>
@endsection
