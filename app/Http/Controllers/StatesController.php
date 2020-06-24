<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStateRequest;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::all();

        return view('states.index', compact('states'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin');
        //die("bok");
        return view('states.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     *  return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {

        //$state = new State();
        //$state->state = request('state');
        //$state->save();
        $this->authorize('admin');

        State::create([
            'state' => $request['state']
        ]);

        return redirect(route('states.index'))->with('success', 'State created!');

    }

    /**
     * Display the specified resource.
     *
     * @param State $state
     * return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //$state = State::findOrFail($id);
        //return $state;
        return view('states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param State $state
     * return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $this->authorize('admin', $state);

        //$state = State::findOrFail($id);
        return view('states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * @param State $state
     * return \Illuminate\Http\Response
     */
    public function update(State $state, StoreStateRequest $request)
    {
        //$state = State::findOrFail($id);

        $this->authorize('admin', $state);

        State::where('id', $state['id'])->update([
            'state' => $request['state']
        ]);

        //$state->state = request('state');
        //$state->save();

        return redirect(route('states.show', $state))->with('success', 'State updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param State $state
     * return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //die("bok");
        //$state = State::findOrFail($id);
        $this->authorize('admin', $state);

        $state->delete();

        return redirect(route('states.index'))->with('success', 'State deleted!');

    }
}
