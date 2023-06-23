<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $devices = [];
        for($i=0; $i<20; $i++){
            $devices[] = [
                'device_uuid' => Str::uuid(),
                'description' => 'Solar monitoring embedded system'
            ];
        }
        DB::table('devices')->insert($devices);
    }
}
