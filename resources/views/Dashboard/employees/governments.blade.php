<label>    المحافظات</label>
<select name="governorate_id" id="governorate_id" class="form-control select2 ">
    <option value="">اختر المحافظة التابع لها الموظف</option>
    @if ( !@empty($governorates))
        @foreach ($governorates as $info )
            <option @if(old('emp_nationality_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
        @endforeach
    @endif
</select>
@error('governorate_id')
<span class="text-danger">{{ $message }}</span>
@enderror
