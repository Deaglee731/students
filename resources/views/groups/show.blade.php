@extends('app')
@section('content')
<div class="container">
        <tbody>
        <form action="{{ route('groups.store') }}" method="POST">
        <h2 style="text-align: center;"> Отображение группы  {{$group->name}} </h2>
        <br>
        <h3 style="text-align: center;"> Тут когда-то появятся студенты </h3>
        @csrf
        </form>
        <form action="{{ route('groups.index') }}" method="GET">
                <button class="btn btn-danger">Back</button>
        </form>
</div>


@endsection
