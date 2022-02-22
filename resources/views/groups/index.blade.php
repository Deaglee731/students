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
                <a href = "{{ route('group.show', ['group' => $group]) }}" >Show</a>
                <br>
                <a href = "{{ route('group.edit', ['group' => $group]) }}" >Edit</a>
                <form action="{{ route('group.destroy', ['group' => $group]) }}" method="POST">
                    @csrf
                    <button class="btn">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $groups->links() }}

<a href = "{{ route('groups.create') }}"> Create </a>
<br>
<a href = "{{ route('subjects.index') }}"> Check the subjects </a>

@endsection
