<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function _construct() {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('access-admin')) {
            abort(403);
        }
        $users = User::all();

        return view('admins.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // $this->aurthorize('create', User::class);

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->aurthorize('create', User::class);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'tel' => 'required|max:10',
            'email' => 'required|max:50'
            
        ]);

        $validated['user_id'] = 1;
        $user = User::create($validated);

        return redirect()->route('user.show', ['user' => $user->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$this->aurthorize('view', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //$this->aurthorize('update', $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$this->aurthorize('update', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$this->aurthorize('delete', $id);
    }
}
