<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Ticket;
use App\Http\Requests\StoreCommentRequest;
use App\Notifications\NewComment;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $comments = Comment::paginate(10);

        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tickets = Ticket::all();
        return view('comments.create', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreCommentRequest $request)
    {

        $ticket = Ticket::find($request['ticket_id']);

        if($ticket->user_id != auth()->user()->id) {
            $ticket->user->notify(new NewComment($request['ticket_id']));
        }
        
        Comment::create([
            'comment' => request('comment'),
            'user_id' => auth()->user()->id,
            'ticket_id' => request('ticket_id')
        ]);

        return redirect(route('tickets.show', $request->ticket_id))->with('success', 'Comment stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        Comment::where('id', $comment['id'])->update([
            'comment' => $request['comment']
        ]);

        return redirect(route('tickets.show', $comment->ticket_id))->with('success', 'Comment updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect(route('tickets.show', $comment->ticket_id))->with('success', 'Comment deleted!');
    }
}
