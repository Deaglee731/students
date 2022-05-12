@extends('app')
@section('content')

<div>
    <form action="{{ route('subjects.store') }}" method="POST">
        <h2 style="text-align: center;"> Отображение предмета {{$subject->name}} </h2>
        <br>
        <h3 style="text-align: center;"> Тут когда-то появятся оценки </h3>
        @csrf
    </form>

    <a class="btn btn-dark" href="{{ route('subjects.index') }}"> Back </a>
</div>

@endsection