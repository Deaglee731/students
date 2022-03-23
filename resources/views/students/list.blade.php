<table class="table table-striped table-bordered table align-middle table-sm">
        <tbody style="text-align: center;">
            <th>id </th>
            <th>Name </th>
            <th>Last Name </th>
            <th>Middle Name </th>
            <th>Group </th>
            <th> Birthday </th>
            @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->middle_name }}</td>
                <td>{{ $student->group->name }}</td>
                <td>{{ $student->birthday }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>