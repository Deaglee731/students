@extends('app')
@section('content')


<div class="container">
    <img src="{{ $avatar }}" class="rounded mx-auto d-block">
    <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update.avatar',['student' => $student]) }}">
        <div class="form mb-3">
            <input name="avatar" type="file" accept="image/*" class="form-control" id="avatar">
        </div>
        <button class="btn btn-primary" type="submit">Сохранить</button>
        @csrf
        @method('POST')
    </form>
    <form method="POST" action="{{ route('profile.update',['student' => $student]) }}">
        <div class="form-floating mb-3 lead">
            <input type="text" id="inputFirstName" name="first_name" value="{{$student->first_name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputFirstName">New first_name</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="text" id="inputLastName" name="last_name" value="{{$student->last_name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputLastName">New last name</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="text" id="inputMiddleName" name="middle_name" value="{{$student->middle_name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputMiddleName">New middle_name</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="date" id="inputBirthday" name="birthday" value="{{$student->birthday}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputBirthday">New birthday</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="text" id="inputEmail" name="email" value="{{$student->email}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputEmail">New email</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="text" id="inputCity" name="city" value=" {{isset($student->address['city']) }}" size="18" class="form-control" style="max-width:max-content  ;" />
            <label for="inputCity">New city</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="text" id="inputStreet" name="street" value=" {{isset($student->address['street']) }}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputStreet">New street</label>
        </div>

        <div class="form-floating mb-3 lead">
            <input type="text" id="inputHome" name="home" value=" {{isset($student->address['home']) }}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputHome">New home</label>
        </div>
        <div class="form-floating mb-3 lead">
            <input type="text" id="inputRole" name="role_id" value=" {{$student->role_id }}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputRole">New role</label>
        </div>
        <p>
            <x-input.select :groups="$groups" :student="$student" />
        </p>

        <button class="btn btn-primary" type="submit">Отправить</button>

</div>
@csrf
@method('POST')
</form>
@endsection
