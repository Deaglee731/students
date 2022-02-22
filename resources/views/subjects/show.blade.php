@extends('app')
@section('content')
<div class="container">
        <tbody>
        <form action="{{ route('subjects.store') }}" method="POST">
        <h2 style="text-align: center;"> Отображение предмета  {{$subject->name}} </h2>
        <br>
        <h3 style="text-align: center;"> Тут когда-то появятся оценки </h3>
        @csrf
        </form>
        <form action="{{ route('subjects.index') }}" method="GET">
                <button class="btn btn-danger">Back</button>
        </form>
</div>


@endsection
