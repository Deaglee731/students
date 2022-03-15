@extends('app')
@section('content')

<div class="container">
    <h2 style="text-align: center;" class="display-6"> Отображение студента {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</h2>
    <br>
    <h3 style="text-align: center;" class="display-7"> Который находится в группе {{ $student->group->name}} </h3>
    <br>
    <h3 style="text-align: center;" class="display-8"> Проживающий по адрессу {{ $student->full_address }} </h3>
    <h3 style="text-align: center;" class="display-8"> Оценки по предметами</h3>
    <br>
    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <th> Предмет </th>
            <th> Оценка </th>
            <th> Администрирование </th>
            @foreach ($student->subjects as $subject)
            <tr>
                <form action="{{ route('scores.delete',['student' => $student]) }}" method="POST">
                    <th score="row">{{$subject->name}} </th>
                    <th> {{ $subject->pivot->score }} </th>
                    <th>
                        <button class="btn btn-danger">Delete </button>
                        <a class="btn btn-secondary" href="{{ route('scores.edit', ['student' => $student , 'subject_id' => $subject->id , 'score' => $subject->pivot->score ]) }}">Edit </a>
                    </th>
                    <input type="hidden" name="subjects_id" value="{{ $subject->id }}" />
                    @method('DELETE')
                    @csrf
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-dark" href="{{ route('students.index') }}"> Back </a>
    <a class="btn btn-success" style="width: auto;" href="{{ route('scores.create', ['student' => $student]) }}">Add Score</a>
</div>
<br>
@endsection