@extends('app')
@section('content')

<div>
    <form action="{{ route('subject.update',['subject' => $subject]) }}" method="POST">
        <h2 style="text-align: center;"> Редактирование предмета  {{$subject->name}} </h2>
        <br>
        @csrf
        <input type="text" name="name" value="{{$subject->name}}" placeholder="Введите новое название группы" size="18" style="background-color:lightsteelblue;"/>
        <br>
        <button class="btn">Save</button>
    </form>
</div>

@endsection
