<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('admin');

        Role::create([
            'role' => $request['role']
        ]);

        return redirect(route('roles.index'))->with('success', 'Role created!');
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $this->authorize('admin', $role);

        //$state = State::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return Response
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        $this->authorize('admin', $role);

        Role::where('id', $role['id'])->update([
            'role' => $request['role']
        ]);

        return redirect(route('roles.show', $role))->with('success', 'Role updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('admin', $role);

        $role->delete();

        return redirect(route('roles.index'))->with('success', 'Role deleted!');
    }
}
