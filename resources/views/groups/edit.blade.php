@extends('app')
@section('content')

<div class="container" style="display: flex; justify-content: center; align-items: center;">
    <form action="{{ route('groups.update',['group' => $group]) }}" method="POST">
        <h3 style="text-align: center;" class="display-7"> Редактирование группы {{$group->name}} </h3>
        <div class="form-floating mb-3">
            <input type="text" id="group_name" name="name" value="{{$group->name}}" size="18" class="form-control" style="max-width:max-content ;" />
            <label for="group_name"> New group name </label>
        </div>
        @method('PUT')
        @csrf
        <button class="btn btn-success">Save</button>
    </form>
</div>

@endsection