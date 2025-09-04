<div class="modal fade" id="createoccasion" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">إضافة شفت جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- نموذج إدخال جزاء موظف -->
                <div class="card p-4">
                    <h3 class="text-lg font-bold mb-4">تسجيل جزاء موظف</h3>

                    <!-- بحث بكود الموظف أو تحديد من قائمة -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="employee_code" class="block mb-1">بحث بكود الموظف</label>
                            <input type="text" id="employee_code" class="form-input w-full" placeholder="أدخل كود الموظف">
                        </div>

                        <div>
                            <label for="employee_select" class="block mb-1">أو اختر من القائمة</label>
                            <select id="employee_select" class="form-select w-full">
                                <option value="">اختر الموظف</option>
                                <!-- يتم تعبئة هذه القائمة بالموظفين -->
                                <option value="1" data-name="أحمد علي" data-daily="150" data-salary="4500">أحمد علي</option>
                                <option value="2" data-name="سارة محمد" data-daily="120" data-salary="3600">سارة محمد</option>
                            </select>
                        </div>
                    </div>

                    <!-- عرض بيانات الموظف تلقائيًا -->
                    <div id="employee_info" class="bg-gray-100 p-3 rounded mb-4 hidden">
                        <p><strong>الاسم:</strong> <span id="emp_name"></span></p>
                        <p><strong>سعر اليوم:</strong> <span id="emp_daily"></span> ريال</p>
                        <p><strong>الراتب الشهري:</strong> <span id="emp_salary"></span> ريال</p>
                    </div>

                    <!-- نوع الجزاء وعدد الأيام -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="penalty_type" class="block mb-1">نوع الجزاء</label>
                            <select id="penalty_type" class="form-select w-full">
                                <option value="">اختر النوع</option>
                                <option value="غياب">غياب</option>
                                <option value="تأخير">تأخير</option>
                                <option value="جزاء إداري">جزاء إداري</option>
                            </select>
                        </div>
                        <div>
                            <label for="days_deducted" class="block mb-1">عدد الأيام المخصومة</label>
                            <input type="number" id="days_deducted" class="form-input w-full" step="0.25" placeholder="مثال: 0.5">
                        </div>
                    </div>

                    <!-- الحساب الآلي للقيمة -->
                    <div class="mb-4">
                        <label for="penalty_amount" class="block mb-1">قيمة الجزاء (تحسب تلقائيًا)</label>
                        <input type="text" id="penalty_amount" class="form-input w-full bg-gray-100" readonly>
                    </div>

                    <!-- سبب الجزاء -->
                    <div class="mb-4">
                        <label for="reason" class="block mb-1">سبب الجزاء</label>
                        <textarea id="reason" class="form-textarea w-full" rows="3"></textarea>
                    </div>

                    <button class="btn btn-primary w-full">حفظ الجزاء</button>
                </div>

                <script>
                    // عند اختيار موظف من القائمة
                    const select = document.getElementById('employee_select');
                    select.addEventListener('change', function () {
                        const option = this.options[this.selectedIndex];
                        const name = option.dataset.name;
                        const daily = parseFloat(option.dataset.daily);
                        const salary = parseFloat(option.dataset.salary);

                        if (name) {
                            document.getElementById('employee_info').classList.remove('hidden');
                            document.getElementById('emp_name').textContent = name;
                            document.getElementById('emp_daily').textContent = daily;
                            document.getElementById('emp_salary').textContent = salary;

                            // عند تغيير عدد الأيام يتم الحساب
                            const daysInput = document.getElementById('days_deducted');
                            daysInput.addEventListener('input', function () {
                                const days = parseFloat(this.value);
                                if (!isNaN(days)) {
                                    document.getElementById('penalty_amount').value = (days * daily).toFixed(2);
                                }
                            });
                        }
                    });
                </script>


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
