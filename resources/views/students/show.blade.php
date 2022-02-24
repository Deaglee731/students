@extends('app')
@section('content')

<div>
    <form action="{{ route('groups.store') }}" method="POST">
        <h2 style="text-align: center;"> Отображение студента   {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</h2>
        <br>
        <h3 style="text-align: center;"> Который находится в группе {{ $student->group->name}} </h3>
        @csrf
    </form>
</div>

<a href = "{{ route('students.index') }}"> Back </a>
@endsection
