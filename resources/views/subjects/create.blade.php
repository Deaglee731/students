@extends('app')
@section('content')

<div>
    <form action="{{ route('subjects.store') }}" method="POST">
        <h2 style="text-align: center;"> Добавление нового предмета </h2>
        <br>
        @csrf
        <input type="text" name="name" placeholder="Введите название предмета" size="18" />
        <br>
        <button class="btn">Add subject</button>
    </form>
</div>

<a href="{{ route('subjects.index') }}"> Back </a>
@endsection