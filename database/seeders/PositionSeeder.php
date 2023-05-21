<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $positions = [
            ['name' => json_encode(['en' => 'goalkeeper']), 'abbreviation' => 'GK'],
            ['name' => json_encode(['en' => 'defender']), 'abbreviation' => 'DF'],
            ['name' => json_encode(['en' => 'midfielder']), 'abbreviation' => 'MF'],
            ['name' => json_encode(['en' => 'attacker']), 'abbreviation' => 'AT'],
        ];
        if (! DB::table('positions')->count()) {
            DB::table('positions')->insert($positions);
        }
    }
}
