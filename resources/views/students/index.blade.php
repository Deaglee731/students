@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Student)</h1>
    <div class="container">
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
                    <th scope="row">{{ $student->id }}</th>
                    <th>{{ $student->first_name }}</td>
                    <th>{{ $student->last_name }}</td>
                    <th>{{ $student->middle_name }}</td>
                    <th> {{ $student->group->name }} </td>
                    <th>
                        <div style="text-align: center;">
                            <a class="btn btn-primary" style="width: auto;" href="{{ route('students.show', ['student' => $student]) }}">Show</a>
                            <a class="btn btn-secondary" style="width: auto;" href="{{ route('students.edit', ['student' => $student]) }}">Edit</a>
                        </div>
                        <form action="{{ route('students.destroy', ['student' => $student]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </th>
                </tr>
                @endforeach
                {{ $students->links() }}
            </tbody>
        </table>
        <th> <a class="btn btn-success" style="width: auto;" href="{{ route('students.create') }}"> Create </a>
    </div>



    <br>

    @endsection