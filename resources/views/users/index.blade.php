@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Users</h1>
    <a href="{{ route('users.create') }}" class="bg-[var(--primary)] text-white px-4 py-2 rounded">Add User</a>
    <ul class="mt-4">
        @foreach ($users as $user)
            <li>{{ $user->name }} ({{ $user->role }})</li>
        @endforeach
    </ul>
@endsection
