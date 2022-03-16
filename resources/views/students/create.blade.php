@extends('app')
@section('content')

<div class="container">
    <form action="{{ route('students.store') }}" method="POST" required="required">
        <h2 style="text-align: center;"> Добавление нового студента </h2>
        <br>
        @csrf
        <!--  First name -->
        <div class="form-floating mb-3">
            <input type="text" id="inputFirstName" name="first_name" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputFirstName">First Name</label>
        </div>
        <!--  Last name -->
        <div class="form-floating mb-3">
            <input type="text" id="inputLastName" name="last_name" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputLastName">Last Name</label>
        </div>
        <!--  Middle name -->
        <div class="form-floating mb-3">
            <input type="text" id="inputMiddleName" name="middle_name" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputMiddleName">Middle Name</label>
        </div>
        <!--  Email -->
        <div class="form-floating mb-3">
            <input type="text" id="inputEmail" name="email" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputEmail">Email</label>
        </div>
        <!--  Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" /> <br>

            <x-input id="password" class="block mt-1 w-full form-control" type="password" style="max-width:max-content;" name="password" required autocomplete="new-password" />
        </div>
        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" /> <br>

            <x-input id="password_confirmation" class="block mt-1 w-full form-control" style="max-width:max-content;" type="password" name="password_confirmation" required />
        </div>
        <!-- Group -->
        <h3> Выберите из списка необходимую группу</h3>
        <p>
            <x-input.select :groups="$groups"/>
        </p>
        <!-- Birthday -->
        <div class="form-floating mb-3">
            <input type="date" id="inputbirthday" name="birthday" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputbirthday">Birthday</label>
        </div>
        <!-- City -->
        <div class="form-floating mb-3">
            <input type="text" id="inputCity" name="city" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputCity"> City</label>
        </div>
        <!-- Street -->
        <div class="form-floating mb-3">
            <input type="text" id="inputStreet" name="street" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputStreet"> Street</label>
        </div>
        <!-- Home -->
        <div class="form-floating mb-3">
            <input type="text" id="inputHome" name="home" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="inputHome"> Home</label>
        </div>
        <button class="btn btn-success">Add Student</button>
    </form>
</div>

<a href="{{ route('students.index') }}"> Back </a>

@endsection