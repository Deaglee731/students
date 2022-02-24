@extends('app')
@section('content')

<div>
    <form action="{{ route('student.update',['student' => $student]) }}" method="POST">
        <h2 style="text-align: center;"> Редактирование студента  {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}} </h2>
        <br>
        @csrf
        <input type="text" name="first_name" value="{{$student->first_name}}" placeholder="Введите новое имя" size="18" style="background-color:lightsteelblue;"/>
        <input type="text" name="last_name" value="{{$student->last_name}}" placeholder="Введите новую фамилию" size="18" style="background-color:lightsteelblue;"/>
        <input type="text" name="middle_name" value="{{$student->middle_name}}" placeholder="Введите новое отчество" size="18" style="background-color:lightsteelblue;"/>
        <p><select name="group_id">
            <option>{{ $student->group->name }}</option>
            @foreach ($groups as $group)
            <option> {{ $group->name }}</option>
            @endforeach
            </select></p>
        <button class="btn">Save</button>
    </form>
</div>

@endsection
