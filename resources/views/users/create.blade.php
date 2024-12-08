@extends('layout')

@section('content')
<h1>Add User</h1>
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    
    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    
    <button type="submit">Save</button>
</form>
@endsection
