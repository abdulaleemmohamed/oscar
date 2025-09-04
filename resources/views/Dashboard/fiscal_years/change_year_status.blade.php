<div class="modal fade" id="open{{$info->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تغيير  الحالة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>هل تريد تغيير حالة  البيانات الاتية ؟</h5>
                <form action="{{route('change_year_status')}}"  method="post">
                    @csrf

                    <h5>هل تريد فتح السنة المالية:  {{$info->FINANCE_YR_DESC}}</h5>

                    <input type="hidden" name="id" value="{{$info->id}}">




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
