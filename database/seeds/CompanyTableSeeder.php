<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('companies')->insert([
            [
                'company_name' => 'Central Services Inc.',
                'code' => 'CSI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => 1
            ],
            [
                'company_name' => 'Central Services Inc.',
                'code' => 'CSI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => 1
            ],
            [
                'company_name' => 'Jobskills Training Center Inc',
                'code' => 'JTCI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => 1
            ],
            [
                'company_name' => 'Serbisyo Outsourcing Facilities Inc',
                'code' => 'SOFI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => 1
            ],
            [
                'company_name' => 'Service Resources Inc',
                'code' => 'SRI',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => 1
            ]
        ]);
    }
}
