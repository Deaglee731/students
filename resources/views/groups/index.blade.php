@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Groups)</h3>
<div class="container">
    <div style="display: flex ; justify-content:right">
        <a class="btn btn-success" style="width: auto;" href="{{ route('groups.create') }}"> Create </a>
    </div>
    <table class="table table-striped table-bordered table align-middle table-sm">
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
                        <div style="text-align: center; display: flex ; justify-content:center">
                            <a class="btn btn-primary" style="width: auto;" href="{{ route('groups.show', ['group' => $group]) }}">Show</a>
                            <a class="btn btn-secondary" style="width: auto;" href="{{ route('groups.edit', ['group' => $group]) }}">Edit</a>
                            <a class="btn btn-dark" style="width: auto;" href="{{ route('group_journal.index', ['group' => $group]) }}">Journal</a>
                            <form action="{{ route('groups.destroy', ['group' => $group]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <th>
        <div style="display: flex ; justify-content:center">
            {{ $groups->links() }}
        </div>
    </th>
</div>
@endsection