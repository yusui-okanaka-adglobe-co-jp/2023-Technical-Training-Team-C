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

        //月曜日
        DB::table('timetables')->insert(
            [
                'day_of_week' => 1,
                'period' => 1,
                'subject' => '社会',
                'teacher_name' => '井村',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 1,
                'period' => 2,
                'subject' => '体育',
                'teacher_name' => '川崎',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 1,
                'period' => 3,
                'subject' => '国語 ',
                'teacher_name' => '内藤',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 1,
                'period' => 4,
                'subject' => '数学',
                'teacher_name' => '佐々木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 1,
                'period' => 5,
                'subject' => '英語',
                'teacher_name' => 'Michael',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 1,
                'period' => 6,
                'subject' => '総合',
                'teacher_name' => '芦屋',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        //火曜日
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 1,
                'subject' => '社会',
                'teacher_name' => '井村',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 2,
                'subject' => '英語',
                'teacher_name' => 'Michael',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 3,
                'subject' => '数学',
                'teacher_name' => '佐々木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 4,
                'subject' => '技術',
                'teacher_name' => '立花',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 5,
                'subject' => '理科',
                'teacher_name' => '青木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 6,
                'subject' => '国語',
                'teacher_name' => '内藤',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        //水曜日
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 1,
                'subject' => '理科',
                'teacher_name' => '青木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 2,
                'subject' => '家庭科',
                'teacher_name' => '山口',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 3,
                'subject' => '英語',
                'teacher_name' => 'Michael',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 4,
                'subject' => '美術',
                'teacher_name' => '沢田',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 5,
                'subject' => '体育',
                'teacher_name' => '川崎',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 6,
                'subject' => '数学',
                'teacher_name' => '佐々木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        //木曜日
        DB::table('timetables')->insert(
            [
                'day_of_week' => 4,
                'period' => 1,
                'subject' => '数学',
                'teacher_name' => '佐々木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 4,
                'period' => 2,
                'subject' => '理科',
                'teacher_name' => '青木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 4,
                'period' => 3,
                'subject' => '英語',
                'teacher_name' => 'Michael',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 4,
                'period' => 4,
                'subject' => '社会',
                'teacher_name' => '井村',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 4,
                'period' => 5,
                'subject' => '体育',
                'teacher_name' => '川崎',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 4,
                'period' => 6,
                'subject' => '国語',
                'teacher_name' => '内藤',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        //金曜日
        DB::table('timetables')->insert(
            [
                'day_of_week' => 5,
                'period' => 1,
                'subject' => '英語',
                'teacher_name' => 'Michael',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 5,
                'period' => 2,
                'subject' => '数学',
                'teacher_name' => '佐々木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 5,
                'period' => 3,
                'subject' => '国語',
                'teacher_name' => '内藤',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 5,
                'period' => 4,
                'subject' => '理科',
                'teacher_name' => '青木',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 5,
                'period' => 5,
                'subject' => '音楽',
                'teacher_name' => '岩崎',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 5,
                'period' => 6,
                'subject' => '道徳',
                'teacher_name' => '芦屋',
                'start_date' => '2023-04-01',
                'end_date' => '2023-08-31',
                'created_at' => '2023-01-01',
            ]
        );

        //臨時など
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 1,
                'subject' => '体育祭練習',
                'teacher_name' => '芦屋',
                'start_date' => '2023-06-01',
                'end_date' => '2023-06-30',
                'created_at' => '2023-05-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 2,
                'subject' => '体育祭練習',
                'teacher_name' => '芦屋',
                'start_date' => '2023-06-01',
                'end_date' => '2023-06-30',
                'created_at' => '2023-05-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 3,
                'subject' => '体育祭練習',
                'teacher_name' => '芦屋',
                'start_date' => '2023-06-01',
                'end_date' => '2023-06-30',
                'created_at' => '2023-05-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 2,
                'period' => 4,
                'subject' => '体育祭練習',
                'teacher_name' => '芦屋',
                'start_date' => '2023-06-01',
                'end_date' => '2023-06-30',
                'created_at' => '2023-05-01',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 1,
                'subject' => '講演会',
                'teacher_name' => '外部講師',
                'start_date' => '2023-05-31',
                'end_date' => '2023-05-31',
                'created_at' => '2023-04-14',
            ]
        );
        DB::table('timetables')->insert(
            [
                'day_of_week' => 3,
                'period' => 2,
                'subject' => '講演会',
                'teacher_name' => '外部講師',
                'start_date' => '2023-05-31',
                'end_date' => '2023-05-31',
                'created_at' => '2023-04-14',
            ]
        );
    }
}
