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
                    <label>عدد الأيام</label>
                    <input type="number" id="edit_days_deducted" class="form-control" min="1">
                </div>
                <div class="mb-3">
                    <label>أجر اليوم</label>
                    <input type="number" id="edit_daily_rate" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label>إجمالي القيمة</label>
                    <input type="number" id="edit_total_value" class="form-control" readonly>
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
                let days = $(this).data('days');
                let total = $(this).data('total');
                let emp_day_salary = $(this).data('emp_day_salary');
                let notes = $(this).data('notes');

                // تعبئة الحقول
                $('#penalty_id').val(penaltyId);
                $('#edit_days_deducted').val(days);
                $('#edit_daily_rate').val(emp_day_salary);
                $('#edit_total_value').val(total);
                $('#edit_notes').val(notes);

                // عرض المودال
                $('#editPenaltyModal').modal('show');
            });
        });
    </script>
@endpush
