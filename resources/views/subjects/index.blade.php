@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Subjects)</h3>
<div class="container">
    <div style="display: flex ; justify-content:right">
        <a class="btn btn-success" style="width: auto;" href="{{ route('subjects.create') }}"> Create </a>
    </div>
    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <form action="{{ route('subjects.index') }}" method="GET">
                <input type="text" name="name" style="border: 2px solid grey; border-radius: 4px;" placeholder="Предмет">
                @csrf
                <button class="btn">FILTER</button>
            </form>
            <a class="btn" style="width: auto;" href="{{ route('subjects.index') }}">Reset</a>
            <th>id </th>
            <th>Название группы </th>
            <th>Администрирование </th>
            @foreach ($subjects as $subject)
            <tr>
                <th scope="row">{{ $subject->id }}</th>
                <td>{{ $subject->name }}</td>
                <td>
                    <div style="text-align: center; display: flex ; justify-content:center">
                        <a class="btn btn-primary" style="width: auto;" href="{{ route('subjects.show', ['subject' => $subject]) }}">Show</a>
                        <a class="btn btn-secondary" style="width: auto;" href="{{ route('subjects.edit', ['subject' => $subject]) }}">Edit</a>
                        <form action="{{ route('subjects.destroy', ['subject' => $subject]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <th>
        <div style="display: flex ; justify-content:center">
            {{ $subjects->appends($request)->links() }}
        </div>
    </th>
</div>
@endsection