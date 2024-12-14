<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        // echo "<script>alert('" . $request['name'] . "');</script>";

        \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // echo "<script type='text/javascript'>alert('$request->name');</script>";
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = \App\Models\User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
    public function show()
    {
        $users = \App\Models\User::all();
        $pdf = Pdf::loadView('users.pdf', compact('users'));
        return $pdf->stream('users.pdf');
    }
}
