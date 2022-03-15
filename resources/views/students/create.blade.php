@extends('app')
@section('content')

<div class="container">
    <form action="{{ route('students.store') }}" method="POST" required="required">
        <h2 style="text-align: center;"> Добавление нового студента </h2>
        <br>
        @csrf
        <div class="form-floating mb-3">
            <input type="text" id="inputFirstName" name="first_name" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputFirstName">First Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputLastName" name="last_name" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputLastName">Last Name</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputMiddleName" name="middle_name" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputMiddleName">Middle Name</label>
        </div>
        <h3> Выберите из списка необходимую группу</h3>
        <p>
            <select name="group_id">
                @foreach ($groups as $name => $id)
                <option value="{{ $id }}"> {{ $name }}</option>
                @endforeach
            </select>
        </p>
        <div class="form-floating mb-3">
            <input type="date" id="inputbirthday" name="birthday" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputbirthday">Birthday</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputCity" name="city" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputCity"> City</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputStreet" name="street" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputStreet"> Street</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" id="inputHome" name="home" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputHome"> Home</label>
        </div>
        <button class="btn btn-success">Add Student</button>
    </form>
</div>

<a href="{{ route('students.index') }}"> Back </a>

@endsection