@extends('app')
@section('content')

<div class="container">
    <img src="{{ $avatar }}" class="rounded mx-auto d-block">
    <h2 style="text-align: center;" class="display-6"> Студент {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</h2>
    <br>
    <h3 style="text-align: center;" class="display-7"> Группа {{ $student->group->name}} </h3>
    <br>
    <h3 style="text-align: center;" class="display-8"> Адрес проживания <br> {{ $student->full_address }} </h3>
    <br>
    <h4 style="text-align: center;" class="display-8"> Оценки по предметами</h4>
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
                    @can('manage-score',$student)
                    <th>
                        <button class="btn btn-danger">Delete </button>
                        <a class="btn btn-secondary" href="{{ route('scores.edit', ['student' => $student , 'subject_id' => $subject->id , 'score' => $subject->pivot->score ]) }}">Edit </a>
                    </th>
                    @endcan
                    <input type="hidden" name="subjects_id" value="{{ $subject->id }}" />
                    @method('DELETE')
                    @csrf
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-dark" href="{{ route('students.index') }}"> Back </a>
    @if (Auth::user()->can('manage-score',$student))
    <a class="btn btn-success" style="width: auto;" href="{{ route('scores.create', ['student' => $student]) }}">Add Score</a>
    @endif
</div>
<br>
@endsection