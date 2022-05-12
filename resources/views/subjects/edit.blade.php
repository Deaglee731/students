@extends('app')
@section('content')

<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <form action="{{ route('subjects.update',['subject' => $subject]) }}" method="POST">
        <h2 style="text-align: center;" class="display-8"> Редактирование предмета {{$subject->name}} </h2>
        <div class="form-floating mb-3">
            <input type="text" name="name"  size="18" id="subjectInput" class="form-control" style="max-width:max-content ;" />
            <label for="subjectInput"> New subject name</label>
            @method('PATCH')
            @csrf
            <button class="btn btn-success">Save</button>
        </div>  
        @csrf
        @method('PUT')
    </form>
</div>

@endsection