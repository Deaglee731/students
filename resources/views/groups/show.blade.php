@extends('app')
@section('content')

<div>
    <form action="{{ route('groups.store') }}" method="POST">
        <h2 style="text-align: center;"> Отображение группы  {{$group->name}} </h2>
        <br>
        <h3 style="text-align: center;"> Тут когда-то появятся студенты </h3>
        @csrf
    </form>
</div>

<a href = "{{ route('groups.index') }}"> Back </a>
@endsection
