@extends('app')
@section('content')

<div>
    <form action="{{ route('groups.update',['group' => $group]) }}" method="POST">
        <h2 style="text-align: center;"> Редактирование группы  {{$group->name}} </h2>
        <br>
        @csrf
        <input type="text" name="name" value="{{$group->name}}" placeholder="Введите новое название группы" size="18" style="background-color:lightsteelblue;"/>
        </p>
        <input type="hidden" name="_method" value="PUT"/>
            @csrf
        <button class="btn">Save</button>
    </form>
</div>

@endsection
