<div class="modal fade" id="delete{{$info->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف البيانات</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('MainSalaryEmployeeAllowances.destroy','test')}}"  method="post">
                    @csrf
                    @method('DELETE')
                    <h5>هل تريد حذف الاضافي الخاص بالموظف :
                        {{ $info->Employee->employee_name }}

                    </h5>

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
