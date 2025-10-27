@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create User</h1>
    <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Name" class="w-full p-2 border rounded">
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded">
        <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded">
        <select name="role" class="w-full p-2 border rounded">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>
        <button type="submit" class="bg-[var(--accent)] text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection
