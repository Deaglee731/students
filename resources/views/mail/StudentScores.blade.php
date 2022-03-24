<table class="table table-striped table-bordered table align-middle table-sm">
    <h4> {{ $student->first_name }} , Ваши оценки по предметам </h4>
    <tbody style="text-align: center;">
        <th>Предмет</th>
        <th>Оценка</th>
        @foreach ($student->subjects as $subject)
        <tr>
            <th score="row">{{$subject->name}}</th>
            <th>{{ $subject->pivot->score }}</th>
        </tr>
        @endforeach
    </tbody>
</table>