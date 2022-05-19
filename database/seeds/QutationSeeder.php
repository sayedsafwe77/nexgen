<?php

namespace Database\Seeders;

use App\Models\Qutation;
use Illuminate\Database\Seeder;

class QutationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qutation::factory()->count(3)->create();
    }
}
