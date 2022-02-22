@extends('app')
@section('content')
<div class="container">
    <table class="table">
        <tbody>
        @foreach ($subjects as $subject)
        <tr>
            <th scope="row">{{ $subject->id }}</th>
            <td>{{ $subject->name }}</td>
            <td>
                <div class="row">
                <form action="{{ route('subject.show', ['subject' => $subject]) }}" method="GET">
                        <button class="btn btn-danger">Show</button>
                </form>
                <form action="{{ route('subject.edit', ['subject' => $subject]) }}" method="GET">
                        <button class="btn btn-danger">Edit</button>
                </form>
                <div class="col-3">
                    <form action="{{ route('subject.destroy', ['subject' => $subject]) }}" method="POST">
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

<form action="{{ route('subjects.create') }}" method="GET">
    @csrf
    <button class="btn">Create</button>
</form>

<form action="{{ route('groups.index') }}" method="GET">
    @csrf
    <button class="btn">Check the group</button>
</form>
@endsection
