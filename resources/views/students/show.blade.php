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
            <form action="{{ route('scores.delete',['student' => $student]) }}" method="POST">
                @foreach ($student->subjects as $subject)
                <th> <br> {{$subject->name}} <br> <button class="submit">Delete</button>
                    <a href="{{ route('scores.edit', ['student' => $student , 'subject_id' => $subject->id , 'score' => $subject->pivot->score ]) }}">Edit </a>
                </th>
                <input type="hidden" name="subjects_id" value="{{ $subject->id }}" />
                @method('DELETE')
                @csrf
                <td>{{ $subject->pivot->score }} </td>
                @endforeach
            </form>
        </tr>
        </tr>
    </table>
</div>
<a href="{{ route('scores.create', ['student' => $student]) }}">Add Score</a>
<br>
<a href="{{ route('students.index') }}"> Back </a>
@endsection