<div class="modal fade" id="editAbsenceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل الغياب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="penalty_id">

                <div class="mb-3">
                    <label>نوع الإضافي</label>
                    <select name="allowance_types_id" id="edit_allowance_types_id" class="form-control">
                        <option value="">اختر</option>
                        @foreach($get_deductions as $addition)
                            <option value="{{ $addition->id }}">{{ $addition->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>إجمالي القيمة</label>
                    <input type="number" name="total" id="edit_total" class="form-control">
                </div>

                <div class="mb-3">
                    <label>ملاحظات</label>
                    <textarea name="notes" id="edit_notes" class="form-control"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="updatePenaltyBtn">حفظ</button>

            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).on('click', '.editAbsenceBtn', function () {
            const penaltyId   = $(this).data('id');
            const total       = $(this).data('total');
            const allowanceId = $(this).data('allowance_types_id');
            const notes       = $(this).data('notes');

            // تعبئة الحقول
            $('#penalty_id').val(penaltyId);
            $('#edit_total').val(total);
            $('#edit_notes').val(notes);

            // ضبط قيمة الـselect
            const $sel = $('#edit_allowance_types_id');
            $sel.val(String(allowanceId)).trigger('change');

            // Debug للتأكد
            console.log("Selected value:", $sel.val());
            console.log("Selected text:", $sel.find('option:selected').text());
        });
    </script>
@endsection
