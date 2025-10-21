@extends('layouts.app')
@section('title', 'User Management | Aronno Bazar')
@section('heading', 'User Management')

@section('content')

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<div class="mt-5 mb-3">
    <button class="px-1 py-1 bg-green-600 text-white rounded hover:bg-green-700 font-normal">
        <a href="{{ route('admin.users.create') }}">+ Create New User</a>
    </button>
</div>

<table class="w-full px-4 bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 items-center text-left mt-5">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ ucfirst($user->role) }}</td>
        <td class="">
            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
