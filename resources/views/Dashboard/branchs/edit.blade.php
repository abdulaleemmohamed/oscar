<!-- Modal تعديل فرع  -->
<div class="modal fade" id="editbranch{{$info->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة فرع جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('Branches.update','test')}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <!-- اسم الفرع -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">اسم الفرع</label>
                                <input type="hidden" name="id" value="{{$info->id}}" class="form-control">
                                <input type="text" name="name" value="{{$info->name}}" class="form-control">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- العنوان -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">العنوان</label>
                                <input type="text" name="address" value="{{$info->address}}" class="form-control">
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- الهاتف -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">الهاتف</label>
                                <input type="text" name="phone" value="{{$info->phone}}" class="form-control">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- الإيميل -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">الإيميل</label>
                                <input type="email" name="email" value="{{$info->email}}" class="form-control">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- حالة التفعيل -->

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
