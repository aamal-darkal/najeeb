<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['key' => 'current_session', 'value' => '2022-2023'],
            ['key' => 'system_title', 'value' => 'Najeb'],
            ['key' => 'system_name', 'value' => 'نجيب أكادمي'],
            ['key' => 'term_ends', 'value' => '7/10/2018'],
            ['key' => 'term_begins', 'value' => '7/10/2018'],
            ['key' => 'phone', 'value' => '+963953672393'],
            ['key' => 'address', 'value' => '18B North Central Park, Behind Central Square Tourist Center'],
            ['key' => 'system_email', 'value' => 'cjacademy@cj.com'],
            ['key' => 'alt_email', 'value' => ''],
            ['key' => 'email_host', 'value' => ''],
            ['key' => 'email_pass', 'value' => ''],
            ['key' => 'lock_exam', 'value' => 0],
            ['key' => 'logo', 'value' => ''],
            ['key' => 'next_term_fees_j', 'value' => '20000'],
            ['key' => 'next_term_fees_pn', 'value' => '25000'],
            ['key' => 'next_term_fees_p', 'value' => '25000'],
            ['key' => 'next_term_fees_n', 'value' => '25600'],
            ['key' => 'next_term_fees_s', 'value' => '15600'],
            ['key' => 'next_term_fees_c', 'value' => '1600'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/'],
            ['key' => 'apk_file', 'value' => null],
            ['key' => 'apk_file_ios', 'value' => null],
            ['key' => 'youtube', 'value' => "https://www.youtube.com"],
            ['key' => 'discount', 'value' => "5"],
            ['key' => 'min_count_day_token', 'value' => "5"],
            ['key' => 'user_name_syriatel', 'value' => "Najeeb-Edu1"],
            ['key' => 'password_syriatel', 'value' => "Najeeb-Edu1"],
            ['key' => 'sender_syriatel', 'value' => "Najeeb-Edu"],
            ['key' => 'count_days_before_', 'value' => "5"],
        ];

        Setting::insert($data);
    }
}
