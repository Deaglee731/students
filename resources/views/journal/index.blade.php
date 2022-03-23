@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Journal)</h3>
<div class="container">
    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <tr>
                <th scope="col">Студенты</th>
                @foreach ($subjects as $subject)
                        <th scope="col">{{ $subject->name }}</th>
                @endforeach
            </tr>
            @foreach ($students_subjects as $student)
            <tr style = "background: {{ $student->color }}">
                <th>{{ $student->first_name }}</th>
                @foreach ($student->subjectsScore as $sub)
                    <th scope="col">{{ isset($sub->pivot->score) ? $sub->pivot->score : '-' }}</th>
                @endforeach                   
            @endforeach
            </tr>
            </tr>
                <th>AVG SCORE</th>
                @foreach ($avgScore as $score)
                    <th scope="col">{{ $score }}</th>
                @endforeach
            </tr>
        </tbody>
    </table>

    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <b>Отличники</b>
            <th>Имя</th>
            <th>фамилия</th>
            <th>Отчество</th>
            <th>Группа</th>
            @foreach ($bestStudents as $student)
            <tr>
                <th>{{ $student->first_name }}</td>
                <th>{{ $student->last_name }}</td>
                <th>{{ $student->middle_name }}</td>
                <th>{{ $student->group->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <b> Ударники</b>
            <th>Имя</th>
            <th>фамилия</th>
            <th>Отчество</th>
            <th>Группа</th>
            @foreach ($goodStudents as $student)
            <tr>
                <th>{{ $student->first_name }}</td>
                <th>{{ $student->last_name }}</td>
                <th>{{ $student->middle_name }}</td>
                <th>{{ $student->group->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<br>
@endsection