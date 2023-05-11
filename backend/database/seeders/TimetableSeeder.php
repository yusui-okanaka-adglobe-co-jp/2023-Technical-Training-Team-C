<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($dayOfWeekCount = 0; $dayOfWeekCount < 7; $dayOfWeekCount++) {
            for ($periodCount = 1; $periodCount < 7; $periodCount++) {
                DB::table('timetables')->insert(
                    [
                        'day_of_week' => $dayOfWeekCount,
                        'period' => $periodCount,
                        'subject' => '国語',
                        'teacher_name' => '内藤',
                        'start_date' => '2023-04-01',
                        'end_date' => '2023-08-31',
                        'created_at' => '2023-01-01',
                    ],
                );
                DB::table('timetables')->insert(
                    [
                        'day_of_week' => $dayOfWeekCount,
                        'period' => $periodCount,
                        'subject' => '英語',
                        'teacher_name' => '佐々木',
                        'start_date' => '2023-04-01',
                        'end_date' => '2023-04-16',
                        'created_at' => '2023-03-31',
                    ],
                );

                DB::table('timetables')->insert(
                    [
                        'day_of_week' => $dayOfWeekCount,
                        'period' => $periodCount,
                        'subject' => '数学',
                        'teacher_name' => '鈴木',
                        'start_date' => '2023-04-04',
                        'end_date' => '2023-04-10',
                        'created_at' => '2023-04-03',
                    ],
                );
            }
        }
    }
}
