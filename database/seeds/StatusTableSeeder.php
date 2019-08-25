<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Making the 2 base status
        Status::create(['name' => 'Scheduled']);
        Status::create(['name' => 'Done']);
    }
}
