@extends('app')
@section('content')

<div>
    <form action="{{ route('scores.update',['student' => $student]) }}" method="POST">
        <h2 style="text-align: center;"> Редактирование оценки студента {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</h2>
        <br>
        <h2 style="text-align: center;"> по предмету {{ $subject->name}}
            <p>
                <input type="hidden" name="subjects_id" value="{{ $subject->id }}" />
                <input type="text" name="score" placeholder="Введите новую оценку" size="18" style="background-color:lightsteelblue;" />
            </p>
            @method('PATCH')
            @csrf
            <button class="btn">Save</button>
    </form>
</div>

@endsection