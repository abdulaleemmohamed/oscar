<div class="modal fade" id="editAbsenceBtn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل الغياب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="penalty_id">

                <div class="mb-3">
                    <label>نوع الاضافي</label>
                    <select name="deduction_types_id" id="edit_deduction_types_id" class="form-control select2">
                        <option value="">اختر  </option>
                        @foreach($get_deductions as $addition)
                            <option value="{{$addition->id}}">{{$addition->name}}  </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label>إجمالي القيمة</label>
                    <input type="number" id="edit_total" class="form-control" >
                </div>
                <div class="mb-3">
                    <label>ملاحظات</label>
                    <textarea id="edit_notes" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="updatePenaltyBtn">حفظ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.editAbsenceBtn', function (e) {
                let penaltyId = $(this).data('id');

                let total = $(this).data('total');
                let deduction_types_id = $(this).data('deduction_types_id');
                let notes = $(this).data('notes');

                // تعبئة الحقول
                $('#penalty_id').val(penaltyId);
                $
                $('#edit_total_value').val(total);
                $('#edit_notes').val(notes);
                $('#edit_deduction_types_id').val(deduction_types_id).trigger('change');


                // لو عايز الاسم المختار كمان
                let name = $('#edit_deduction_types_id option:selected').text();
                console.log("Selected ID:", deduction_types_id);
                console.log("Selected Name:", name);
                // عرض المودال
                $('#editPenaltyModal').modal('show');
            });
        });
    </script>
@endpush
