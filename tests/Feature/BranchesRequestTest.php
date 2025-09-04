<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin; // لو بتحتاج يوزر مسجّل

class BranchesRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_required_fields()
    {
        // نحتاج نستخدم مستخدم مسجّل (auth) إذا الريكوست يحتاج

        // نرسل بيانات فاضية ونشوف إذا الفاليديشن يشتغل
        $response = $this->post(route('Branches.store'), []);

        // نتحقق من إنه رجع أخطاء على الحقول المطلوبة
        $response->assertSessionHasErrors([
            'name',
            'phone',
            'address',
            'is_active',
        ]);
    }

    /** @test */
    public function it_passes_validation_with_correct_data()
    {

        // بيانات صحيحة
        $data = [
            'name' => 'فرع جدة',
            'phone' => '0555555555',
            'address' => 'جدة - حي الشاطئ',
            'is_active' => 1,
            'email' => 'branch@example.com', // لو حاطه في الريكوست
        ];

        $response = $this->post(route('Branches.store'), $data);

        // نتأكد إنه ما فيه أخطاء فاليديشن
        $response->assertSessionDoesntHaveErrors();

        // نتأكد من إعادة التوجيه بعد الحفظ
        $response->assertRedirect(route('Branches.index'));
    }
}
