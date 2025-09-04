<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_fails_validation_with_missing_fields()
    {
        $response = $this->post('/employees', []); // استبدل بالراوت الصحيح

        $response->assertSessionHasErrors([
            'employee_name',
            'zketo_code',
            'employee_gender',
            'branch_id',
            'Qualifications_id',
            'Qualifications_year',
            'employee_national_identity',
            'employee_identityPlace',
            'employee_end_identityIDate',
            'blood_group_id',
            'employee_Departments_code',
            'employee_jobs_id',
            'employee_sal',
            'MotivationType',
            'isSocialnsurance',
            'ismedicalinsurance',
            'sal_cach_or_visa',
            'brith_date',
        ]);
    }

    /** @test */
    public function it_passes_validation_with_valid_data()
    {
        $validData = [
            'employee_name' => 'أحمد يوسف',
            'zketo_code' => '123456',
            'employee_gender' => 1,
            'branch_id' => 1,
            'Qualifications_id' => 1,
            'Qualifications_year' => 2022,
            'employee_national_identity' => '12345678901234',
            'employee_identityPlace' => 'القاهرة',
            'employee_end_identityIDate' => '2030-12-31',
            'blood_group_id' => 1,
            'employee_Departments_code' => 100,
            'employee_jobs_id' => 2,
            'employee_sal' => 5000,
            'MotivationType' => 'دوام كامل',
            'isSocialnsurance' => true,
            'ismedicalinsurance' => true,
            'sal_cach_or_visa' => 'visa',
            'brith_date' => '1995-05-01',
        ];

        $response = $this->post('/employees', $validData);

        $response->assertSessionDoesntHaveErrors();
    }
}
