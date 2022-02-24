@extends('app')
@section('content')

<div>
    <form action="{{ route('groups.store') }}" method="POST">
        <h2 style="text-align: center;"> Добавление новой группы </h2>
        <br>
        @csrf
        <p>
        <input type="text" name="name" placeholder="Введите название группы" size="18" /></p>
        <button class="btn">Add group</button>
    </form>  
</div>

<a href = "{{ route('groups.index') }}"> Back </a>

@endsection
