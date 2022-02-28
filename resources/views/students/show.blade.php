@extends('app')
@section('content')

<div>
    <h2 style="text-align: center;"> Отображение студента {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</h2>
    <br>
    <h3 style="text-align: center;"> Который находится в группе {{ $student->group->name}} </h3>
    <br>
    <h3>Оценки по предметами</h3>
    <table class="table">
        <tr>
        <tr>
            <form action="{{ route('student.deleteScore',['student' => $student]) }}" method="POST">
                @foreach ($student->subjects as $subject)
                <th> <br> {{$subject->name}} <br> <button class="submit">Delete</button> </th>
                <input type="hidden" name="subjects_id" value="{{ $subject->id }}" />
                @method('DELETE')
                @csrf
                @endforeach
            </form>
        </tr>
        @foreach ($scores as $score)
        <th>
            {{ $score->score }}
            <form action="{{ route('student.editScore', ['student' => $student , 'subject_id' => $score->subjects_id]) }}" method="POST">
                <input type="hidden" name="score" value="{{ $score->score }}" />
                <input type="hidden" name="subject_id" value="{{ $score->subjects_id }}" />
                <button class="btn">Edit</button>
                @csrf
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