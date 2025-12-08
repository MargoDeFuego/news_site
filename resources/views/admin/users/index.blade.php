@extends('layouts.app')


@section('content')
    <h1>Пользователи</h1>

@can('manage-users')
    <li><a href="{{ route('admin.users.index') }}">Пользователи</a></li>
@endcan

<ul>
    <li><a href="{{ route('admin.news') }}">Управление новостями</a></li>
    <li><a href="{{ route('admin.gallery') }}">Управление галереей</a></li>
</ul>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действие</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name ?? '—' }}</td>

                    <td>
                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                            @csrf

                            <select name="role_id" class="form-select">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" 
                                        @selected($user->role_id == $role->id)>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            <button class="btn btn-primary btn-sm mt-1">
                                Сохранить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
@endsection
