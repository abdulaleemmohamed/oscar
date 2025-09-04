<div class="modal fade" id="createdepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة وظيفية جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('job_categories.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- اسم الإدارة -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">اسم الوظيفية</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <!-- حالة التفعيل -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active">حالة التفعيل</label>
                                <select name="is_active" id="is_active" class="form-control">
                                    <option value="1" selected>مفعل</option>
                                    <option value="0">معطل</option>
                                </select>
                                @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
