@extends('app')
@section('content')

<div>
    <table class="table">
        <tbody>
        @foreach ($groups as $group)
        <tr>
            <th scope="row">{{ $group->id }}</th>
            <td>{{ $group->name }}</td>
            <td>
                <div class="row">
                <form action="{{ route('group.show', ['group' => $group]) }}" method="GET">
                        <button class="btn btn-danger">Show</button>
                </form>
                <form action="{{ route('group.edit', ['group' => $group]) }}" method="GET">
                        <button class="btn btn-danger">Edit</button>
                </form>
                <div class="col-3">
                    <form action="{{ route('group.destroy', ['group' => $group]) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<form action="{{ route('groups.create') }}" method="GET">
    @csrf
    <button class="btn">Create</button>
</form>

<form action="{{ route('subjects.index') }}" method="GET">
    @csrf
    <button class="btn">Check the subjects</button>
</form>

@endsection
