@extends('app')
@section('content')

<div>
    <h2 style="text-align: center;"> Отображение студента {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</h2>
    <br>
    <h3 style="text-align: center;"> Который находится в группе {{ $student->group->name}} </h3>
    <br>
    <table class="table">
        <caption>Оценки</caption>
        <tr>
            @foreach ($subjects as $subject)
            <th> {{$subject->name}} </th>
            @endforeach
        </tr>
        <tr>
            @foreach ($scores as $score)
            <th>
                {{ $score->score }}
                <form action="{{ route('student.deleteScore',['student' => $student, 'score' => $score->score]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn">Delete</button>
                </form>
            </th>
            @endforeach
        </tr>

        </tr>
    </table>
</div>
<a href="{{ route('student.showScore', ['student' => $student]) }}">Add Score</a>
<br>
<a href="{{ route('students.index') }}"> Back </a>
@endsection