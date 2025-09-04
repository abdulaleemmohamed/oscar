<label>المدن</label>
<select name="city_id" id="city_id" class="form-control select2 ">
    <option value="">اختر المدينة التابع لها الموظف</option>
    @if ( !@empty($cities))
        @foreach ($cities as $info )
            <option @if(old('emp_nationality_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
        @endforeach
    @endif
</select>
@error('city_id')
<span class="text-danger">{{ $message }}</span>
@enderror
