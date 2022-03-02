@extends('app')
@section('content')

<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <form action="{{ route('scores.store', ['student' => $student]) }}" method="POST" required="required">
        <h2 style="text-align: center;" class="display-6"> Добавление новой оценки студенту {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}} </h2>
        <h4 style="text-align: center;" class="display-7"> Выберите из списка необходимый предмет</h4>
        <select class="form-select mb-3" style="max-width: max-content;" name="subject_id">
            @foreach ($subjects as $subject)
            <option value="{{ $subject->id }}"> {{ $subject->name }}</option>
            @endforeach
        </select>
        <div class="form-floating mb-3">
            <input type="text" name="score" size="18" id="scoreInput" class="form-control" style="max-width:max-content ;" />
            <label for="scoreInput">SCORES</label>
        </div>
        <button class="btn btn-success">ADD</button>
        <a class="btn btn-dark" href="{{ route('students.index') }}"> Back </a>
        @csrf
    </form>

</div>

@endsection