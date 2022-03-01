@extends('app')
@section('content')

<div>
    <form action="{{ route('scores.create', ['student' => $student]) }}" method="POST" required="required">
        <h2 style="text-align: center;"> Добавление новой оценки студенту {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}} </h2>
        <br>
        @csrf
        <h3> Выберите из списка необходимый предмет</h3>
        <p>
            <select name="subject_id">
                @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}"> {{ $subject->name }}</option>
                @endforeach
            </select>
            <input type="text" name="score" placeholder="Введите оценку" size="18" />
        </p>
        <button class="btn">Add Scores to Student</button>
    </form>
</div>
<a href="{{ route('students.index') }}"> Back </a>

@endsection