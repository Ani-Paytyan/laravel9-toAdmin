<?php

namespace Database\Seeders;

use App\Models\CompanyType;
use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyTypes = [
            [
                'id' => 1,
                'name' => 'Own',
            ],
            [
                'id' => 2,
                'name' => 'Client'
            ]
        ];
        foreach($companyTypes as $type) { CompanyType::create($type); }
    }
}
