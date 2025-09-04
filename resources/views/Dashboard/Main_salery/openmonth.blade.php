
<div class="modal fade" id="attendanceModal{{$info->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">فتح الشهر المالي </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form  id="attendanceForm" action="{{ route('Main_Salery.open_month', $info->id) }}" method="POST">

                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="attendanceModalLabel">تحديد بداية ونهاية بصمة الشهر</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="month_id" value="{{ $info->id }}">

                            <div class="mb-3">
                                <label for="start_date" class="form-label">بداية البصمة</label>
                                <input type="date" class="form-control" name="start_date_for_pasma" value="{{$info->start_date_for_pasma}}">
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">نهاية البصمة</label>
                                <input type="date" class="form-control" name="end_date_for_pasma"  value="{{$info->end_date_for_pasma}}">
                            </div>
                        </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary" onclick="confirmWithSweetAlert()">فتح الشهر </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

<script>
    function confirmSubmit() {
        if (confirm("هل أنت متأكد من حفظ تواريخ البصمة؟")) {
            document.querySelector('#attendanceModal form').submit();
        }
    }
</script>
