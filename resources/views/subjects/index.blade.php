@extends('app')
@section('content')
<h3 style="text-align: center;" class="display-4">FWT_education (Subjects)</h1>
<div class="container">
    <table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <th>id </th>
            <th>Название группы </th>
            <th>Администрирование </th>
            @foreach ($subjects as $subject)
            <tr>
                <th scope="row">{{ $subject->id }}</th>
                <td>{{ $subject->name }}</td>
                <td>
                    <div style="text-align: center;">
                    <a class="btn btn-primary" style="width: auto;" href="{{ route('subjects.show', ['subject' => $subject]) }}">Show</a>
                    <a class="btn btn-secondary" style="width: auto;" href="{{ route('subjects.edit', ['subject' => $subject]) }}">Edit</a>
                    </div>
                    <form action="{{ route('subjects.destroy', ['subject' => $subject]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            {{ $subjects->links() }}
        </tbody>
    </table>
    <th><a class="btn btn-success" style="width: auto;" href="{{ route('subjects.create') }}"> Create </a></th>
</div>

<br>
@endsection