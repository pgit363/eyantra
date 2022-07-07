<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\College;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        College::truncate();

        $countries = [
            ['name' => 'American Samoa'],
            ['name' => 'India'],
        ];
        
        $colleges = [
            ['country_id'=>'1', 'name' => 'VIT, Wadala'],
            ['country_id'=>'1', 'name' => 'D.Y.Patil'],
            ['country_id'=>'1', 'name' => 'Pillai, Panvel'],
            ['country_id'=>'1', 'name' => 'VJTI'],
            ['country_id'=>'2', 'name' => 'GreenWitch'],
            ['country_id'=>'2', 'name' => 'Universal'],
            ['country_id'=>'2', 'name' => 'Oxford'],
            ['country_id'=>'2', 'name' => 'Eductaion Tech'],
        ];

        foreach ($countries as $key => $value) {
            Country::create($value);
        }
        foreach ($colleges as $key => $value) {
            College::create($value);
        }
    }
}
