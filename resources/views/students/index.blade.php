@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Student)</h3>
<div class="container">
    @can('create',App\Models\Student::class)
    <div style="display: flex ; justify-content:right">
        <a class="btn btn-success" style="width: auto;" href="{{ route('students.create') }}"> Create </a>
    </div>
    <form action="{{ route('students.download') }}" method="POST">
        <div style="display: flex ; justify-content:right">
            <button class="btn btn-success">Download</button>
        </div>
        @csrf
    </form>
    @endcan
    <table class="table table-striped table-bordered table align-middle table-sm">
        <form action="{{ route('students.index') }}" method="GET">
            <input type="text" value="{{ isset($request['firstname']) ? $request['firstname'] : null }}" name="firstname" style="border: 2px solid grey; border-radius: 4px;" placeholder="Имя">
            <input type="text" value="{{ isset($request['lastname']) ? $request['lastname'] : null }}" name="lastname" style="border: 2px solid grey; border-radius: 4px;" placeholder="Фамилия">
            <input type="text" value="{{ isset($request['middlename']) ? $request['middlename'] : null }}" name="middlename" style="border: 2px solid grey; border-radius: 4px;" placeholder="Логин">
            <input type="date" value="{{ isset($request['birthday']) ? $request['birthday'] : 'null' }}" name="birthday" style="border: 2px solid grey; border-radius: 4px;" placeholder="Дата">
            @csrf
            <button class="btn">FILTER</button>
        </form>
        <a class="btn" style="width: auto;" href="{{ route('students.index') }}">Reset</a>
        <tbody style="text-align: center;">
            <th>id </th>
            <th>Имя </th>
            <th>фамилия </th>
            <th>Отчество </th>
            <th>Группа </th>
            <th> День рождения </th>
            <th> Администрирование </th>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->middle_name }}</td>
                <td> {{ $student->group->name }} </td>
                <td> {{ $student->birthday }} </td>
                <td>
                    <div style="text-align: center; display: flex ; justify-content:center">
                        <a class="btn btn-primary" style="width: auto;" href="{{ route('students.show', ['student' => $student]) }}">Show</a>
                        @can('edit',$student)
                        <a class="btn btn-secondary" style="width: auto;" href="{{ route('students.edit', ['student' => $student]) }}">Edit</a>
                        @endcan
                        @can('delete',$student)
                        <form action="{{ route('students.destroy', ['student' => $student]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display: flex ; justify-content:center">
        {{ ($students->appends($request)->links()) }}
    </div>
</div>
<br>
@endsection