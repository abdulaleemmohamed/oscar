<div class="modal fade" id="edit{{ $info->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل المناسبة {{$info->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('occasions.update','test') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- اسم الفرع -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">نوع الشفت</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $info->name}}" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- العنوان -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">من يوم</label>
                                <input type="hidden"name="id" value="{{ $info->id}}">
                                <input type="date" name="from_date" id="from_date" class="form-control" value="{{ $info->from_date}}" >
                                @error('from_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- الهاتف -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">الي يوم </label>
                                <input type="date" name="to_date" id="to_date" class="form-control" value="{{ $info->to_date}}" >
                                @error('to_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- الإيميل -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">عدد الايام</label>
                                <input type="text" name="days_counter" id="days_counter" class="form-control" value="{{ $info->days_counter}}">
                                @error('days_counter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- حالة التفعيل -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="is_active">حالة التفعيل</label>
                                <select name="active" id="active" class="form-control">
                                    <option selected value="1">مفعل</option>
                                    <option value="0">معطل</option>
                                </select>
                                @error('active')
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
