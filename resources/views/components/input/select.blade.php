<select name="group_id" class="form-select mb-3 lead" style="max-width: max-content;">
    @foreach ($groups as $name => $id)
    <option value="{{ $id }}"> {{ $name }}</option>
    @endforeach
</select>