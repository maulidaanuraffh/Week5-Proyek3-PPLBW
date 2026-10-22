@extends('layouts.app')
@section('title', 'Kelola User')

@section('content')
<h2 style="margin-bottom: 1.25rem;">Kelola User</h2>

@if (session('status'))
    <div class="alert-success">{{ session('status') }}</div>
@endif
@if ($errors->first('role'))
    <div class="alert-error">{{ $errors->first('role') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>ID User</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $u)
        <tr>
            <td>{{ $u->id_user }}</td>
            <td>{{ $u->nama_lengkap }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->role }}</td>
            <td>
                @if ($u->role === 'admin')
                    —
                @else
                    <form method="POST" action="{{ route('admin.users.role.update', $u->id_user) }}" style="display:flex; gap:0.5rem; align-items:center;">
                        @csrf
                        @method('PATCH')
                        <select name="role" style="padding:0.3rem; border-radius:4px; border:1px solid #ccc;">
                            <option value="customer" {{ $u->role === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="staff" {{ $u->role === 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        <button type="submit" class="btn btn-primary" style="font-size:0.85rem;">Ubah</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection