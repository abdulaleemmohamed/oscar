<div class="modal fade" id="editPenaltyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">تعديل الجزاء</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="penalty_id">

                <div class="form-group">
                    <label>نوع الجزاء</label>
                    <select id="edit_Sanctions_types" class="form-control select2">
                        <option value="1">تحقيق</option>
                        <option value="2">غياب</option>
                        <option value="3">إداري</option>
                        <option value="4">أخرى</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>عدد الأيام</label>
                    <input type="number" id="edit_days_deducted" class="form-control">
                </div>

                <div class="form-group">
                    <label>الإجمالي</label>
                    <input type="text" id="edit_total_value" class="form-control" readonly>
                </div>
            </div>

            <div class="modal-footer">
                <button id="updatePenaltyBtn" class="btn btn-success">حفظ التعديلات</button>
            </div>

        </div>
    </div>
</div>
