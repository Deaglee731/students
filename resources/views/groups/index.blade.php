@extends('app')
@section('content')
<div class="container">
    <table class="table">
        <tbody>
        @foreach ($groups as $group)
        <tr>
            <th scope="row">{{ $group->id }}</th>
            <td>{{ $group->name }}</td>
            <td>
                <div class="row">
                <div class="col-3"><a class="btn btn-primary" href="/groups/{{ $group }}">Show</a></div>
                <div class="col-3"><a class="btn btn-success" href="/groups/{{ $group }}/edit">Edit</a></div>
                <div class="col-3">
                    <form action="{{ route('group_destroy', ['group' => $group]) }}" method="POST">
                        @method('DELETE')
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

@endsection
