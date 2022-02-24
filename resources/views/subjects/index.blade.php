@extends('app')
@section('content')

<div>
    <table class="table">
        <tbody>
        @foreach ($subjects as $subject)
        <tr>
            <th scope="row">{{ $subject->id }}</th>
            <td>{{ $subject->name }}</td>
            <td>
                <a href = "{{ route('subject.show', ['subject' => $subject]) }}" >Show</a>
                <br>
                <a href = "{{ route('subject.edit', ['subject' => $subject]) }}" >Edit</a>
                <form action="{{ route('subject.destroy', ['subject' => $subject]) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<a href = "{{ route('subjects.create') }}"> Create </a>
<br>
<a href = "{{ route('groups.index') }}"> Check the group </a>

@endsection