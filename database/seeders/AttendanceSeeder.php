<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        $startDate = Carbon::create(2024, 8, 1);
        $endDate   = Carbon::create(2024, 8, 27);
        $numberOfRecords = 150;

        for ($i = 0; $i < $numberOfRecords; $i++) {
            do {
                $randomDate = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));
            } while ($randomDate->isWeekend());

            $signInTime  = Carbon::createFromTime(rand(9, 15), rand(0, 59));
            $signOutTime = Carbon::createFromTime(rand($signInTime->hour + 1, 15), rand(0, 59));

            DB::table('attendance')->insert([
                'user_id'      => $faker->randomElement(['1', '2', '3']),
                'date'         => $randomDate->format('Y-m-d'),
                'sign_in_time' => $signInTime->format('H:i:s'),
                'sign_out_time' => $signOutTime->format('H:i:s'),
            ]);
        }



    }
}
