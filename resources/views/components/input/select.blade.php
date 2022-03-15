<select name="group_id" class="form-select mb-3 lead" style="max-width: max-content;">
    <option value="{{ $student->group->id }}" selected> {{$student->group->name}} </option>
    @foreach ($groups as $name => $id)
    <option value="{{ $id }}"> {{ $name }}</option>
    @endforeach
</select>