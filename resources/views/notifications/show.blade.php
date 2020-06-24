@extends('layouts.layout')

@section('content')

    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-left">Notifications</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                    <tr>
                        <td class="text-left">
                        @if ($notification->type === 'App\Notifications\TicketReassigned')
                            <a href="{{route('tickets.show', $notification->data['ticket_id'] )}}">
                                A ticket has been assigned to you.</a>
                        @endif
                        @if ($notification->type === 'App\Notifications\NewComment')
                            <a href="{{route('tickets.show', $notification->data['ticket_id'] )}}">
                                There is a new comment on your ticket.</a>
                        @endif
                        </td>
                    </tr>
                    @empty
                    <td class="text-left">You have no unread notifications.</td>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
