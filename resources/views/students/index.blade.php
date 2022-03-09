@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Student)</h3>
<div class="container">
    <div style="display: flex ; justify-content:right">
        <a class="btn btn-success" style="width: auto;" href="{{ route('students.create') }}"> Create </a>
    </div>
    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <th>id </th>
            <th>Имя </th>
            <th>фамилия </th>
            <th>Отчество </th>
            <th>Группа </th>
            <th> Администрирование </th>
            @foreach ($students as $student)
            <tr>
                <th>{{ $student->id }}</th>
                <th>{{ $student->first_name }}</td>
                <th>{{ $student->last_name }}</td>
                <th>{{ $student->middle_name }}</td>
                <th> {{ $student->group->name }} </td>
                <th>
                    <div style="text-align: center; display: flex ; justify-content:center">
                        <a class="btn btn-primary" style="width: auto;" href="{{ route('students.show', ['student' => $student]) }}">Show</a>
                        <a class="btn btn-secondary" style="width: auto;" href="{{ route('students.edit', ['student' => $student]) }}">Edit</a>
                        <form action="{{ route('students.destroy', ['student' => $student]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
    <th>
        <div style="display: flex ; justify-content:center">
            {{ $students->links() }}
        </div>
    </th>
</div>
<br>
@endsection