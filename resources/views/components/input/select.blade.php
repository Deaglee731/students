<select name="group_id" class="form-select mb-3 lead" style="max-width: max-content;">
    @foreach ($groups as $name => $id)
    <option value="{{ $id }}" @if($student->group->id === $id) selected @endif> {{ $name }}</option>
    @endforeach
</select>