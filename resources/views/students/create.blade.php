@extends('app')
@section('content')

<div>
    <form action="{{ route('students.store') }}" method="POST">
        <h2 style="text-align: center;"> Добавление нового студента </h2>
        <br>
        @csrf
        <p>
        <input type="text" name="first_name" placeholder="Введите имя" size="18" /></p>
        <input type="text" name="last_name" placeholder="Введите фамилию" size="18" /></p>
        <input type="text" name="middle_name" placeholder="Введите отчество" size="18" /></p>
        <p><select name="group_id">
            <option>Выберите из списка</option>
            @foreach ($groups as $group)
            <option> {{ $group->name }}</option>
            @endforeach
            </select></p>
        <button class="btn">Add student</button>
    </form>  
</div>

<a href = "{{ route('students.index') }}"> Back </a>

@endsection
