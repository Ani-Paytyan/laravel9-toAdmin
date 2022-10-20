<?php

namespace Database\Seeders;

use App\Models\ManufactureType;
use Illuminate\Database\Seeder;

class ManufactureTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $manufactureTypes = [
            [
                'id' => 1,
                'name' => 'RadioLand',
            ],
            [
                'id' => 2,
                'name' => 'Minew'
            ]
        ];
        foreach($manufactureTypes as $type) { ManufactureType::updateOrCreate($type); }
    }
}
