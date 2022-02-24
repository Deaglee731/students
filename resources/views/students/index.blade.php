@extends('app')
@section('content')

<div class="container" style="margin-left: 400px;">
    <table class="table">
        <tbody>
            <th>id </th>
            <th>Имя </th>
            <th>фамилия </th>
            <th>Отчество </th>
            <th>Группа </th>
            <th> Администрирование </th>
        @foreach ($students as $student)
        <tr>
            <th scope="row">{{ $student->id }}</th>
            <th>{{ $student->first_name }}</td>
            <th>{{ $student->last_name }}</td>
            <th>{{ $student->middle_name }}</td>
            <th> {{ $student->group->name }} </td>
            <th>
                <div class="row">
                <a href = "{{ route('students.show', ['student' => $student]) }}" >Show</a>
                <br>
                <a href = "{{ route('students.edit', ['student' => $student]) }}" >Edit</a>
                <form action="{{ route('students.destroy', ['student' => $student]) }}"  method="POST">
                    <input type="hidden" name="_method" value="delete"/>
                    @csrf
                    <button class="btn">Delete</button>
                </form>
            </th>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
{{ $students->links() }}

<a href = "{{ route('students.create') }}"> Create </a>
<br>
<a href = "{{ route('subjects.index') }}"> Check the subjects </a>

@endsection
