<div class="modal fade" id="createShift" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة شفت جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('Work_Shifts.store') }}" method="post">
                    @csrf

                    <div class="row">
                        <!-- اسم الفرع -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">نوع الشفت</label>
                                <select name="shift_type" id="shift_type" class="form-control">
                                    <option value="">اختر النوع</option>
                                    <option @if(old('shift_type')==1) selected @endif value="1">صباحي</option>
                                    <option @if(old('shift_type')==2) selected @endif value="2">مسائي</option>
                                    <option @if(old('shift_type')==3) selected @endif value="3"> يوم كامل</option>
                                </select>
                                @error('shift_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- العنوان -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">من الساعة</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('from_time') }}" >
                                @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- الهاتف -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">الي الساعة </label>
                                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('to_time') }}" >
                                @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- الإيميل -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">عدد الساعات</label>
                                <input type="text" name="work_hours" id="work_hours" class="form-control">
                                @error('work_hours')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- حالة التفعيل -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_active">حالة التفعيل</label>
                                <select name="is_active" id="is_active" class="form-control">
                                    <option selected value="1">مفعل</option>
                                    <option value="0">معطل</option>
                                </select>
                                @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق
                        </button>
                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
