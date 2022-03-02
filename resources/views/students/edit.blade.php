@extends('app')
@section('content')

<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <form action="{{ route('students.update',['student' => $student]) }}" method="POST">
        <h2 style="text-align: center;"> Редактирование студента {{$student->first_name}} {{$student->last_name}} {{$student->middle_name}} </h2>
        <div class="form-floating mb-3">
            <input type="text" id="inputName" name="first_name" value="{{$student->first_name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputName"> New name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputLastName" name="last_name" value="{{$student->last_name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputLastName"> New last name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputMiddleName" name="middle_name" value="{{$student->middle_name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputMiddleName"> New middle name</label>
        </div>
        <h4 class="display-8">Текущая группа студента {{ $student->group->name }} </h4>
        <p>
            <select name="group_id" class="form-select mb-3" style="max-width: max-content;">
                @foreach ($groups as $name => $id)
                <option value="{{ $id }}"> {{ $name }}</option>
                @endforeach
            </select>
        </p>
        @method('PUT')
        @csrf
        <button class="btn btn-success">Save</button>
    </form>
</div>

@endsection