@extends('app')
@section('content')
<div class="container">
        <tbody>
        <form action="{{ route('group.update',['group' => $group]) }}" method="POST">
        <h2 style="text-align: center;"> Редактирование группы  {{$group->name}} </h2>
        <br>
        @csrf
        <input type="text" name="name" value="{{$group->name}}" placeholder="Введите новое название группы" size="18" style="background-color:lightsteelblue;"/>
        </p>
        <button class="btn">Save</button>
        </form>
</div>


@endsection
