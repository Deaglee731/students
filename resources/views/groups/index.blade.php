@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Groups)</h1>
<div class="container" >
    <table class="table table-striped table-bordered table align-middle table-sm" > 
        <tbody style="text-align: center;">
            <th>id </th>
            <th>Название </th>
            <th>Администрирование </th>
            @foreach ($groups as $group)
            <tr style="text-align: center;">
                <th scope="row">{{ $group->id }}</th>
                <td>{{ $group->name }}</td>
                <td>
                    <div class="row">
                        <div style="text-align: center;">
                        <a  class ="btn btn-primary" style="width: auto;" href="{{ route('groups.show', ['group' => $group]) }}">Show</a>
                        
                        <a  class ="btn btn-secondary" style="width: auto;" href="{{ route('groups.edit', ['group' => $group]) }}">Edit</a>
                        </div>
                        <form action="{{ route('groups.destroy', ['group' => $group]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                </td>
            </tr>
            @endforeach
            {{ $groups->links() }}
        </tbody>
    </table>
    <th><a class ="btn btn-success" style="width: auto;" href="{{ route('groups.create') }}"> Create </a></th>
</div>
<br>

@endsection