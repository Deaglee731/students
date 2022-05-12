@extends('app')
@section('content')

<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <form action="{{ route('scores.update',['student' => $student]) }}" method="POST">
        <h3 style="text-align: center;" class="display-8"> Редактирование оценки студента <b>{{$student->first_name}} {{$student->last_name}} {{$student->middle_name}}</b></h3>
        <br>
        <h4 style="text-align: center;" class="display-8"> по предмету {{ $subject->name}} </h4>
        <div class="form-floating mb-3">
            <input type="hidden" name="subjects_id" value="{{ $subject->id }}" />
            <input type="text" name="score" size="18" id="scoreInput" class="form-control" style="max-width:max-content ;" />
            <label for="scoreInput">SCORES</label>
            @method('PATCH')
            @csrf
            <button class="btn btn-success">Save</button>
        </div>
    </form>
</div>

@endsection