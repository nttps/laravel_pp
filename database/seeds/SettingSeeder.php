<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $settings = [
            ['name' => 'site_title', 'title' => 'Site Title', 'value' => '', 'type' => 'text', 'options' => '', 'description' => '', 'sorting_number' => '1', 'groups' => 'general'],
            ['name' => 'site_description', 'title' => 'Site Description', 'value' => '', 'type' => 'textarea', 'options' => '', 'description' => '', 'sorting_number' => '2', 'groups' => 'general'],
            ['name' => 'site_email', 'title' => 'Site Email', 'value' => '', 'type' => 'text', 'options' => '', 'description' => '', 'sorting_number' => '3', 'groups' => 'general'],
            ['name' => 'site_keywords', 'title' => 'Site Keywords', 'value' => '', 'type' => 'text', 'options' => '', 'description' => '', 'sorting_number' => '4', 'groups' => 'general'],
            ['name' => 'site_telephone', 'title' => 'Site Telephone', 'value' => '', 'type' => 'text', 'options' => '', 'description' => '', 'sorting_number' => '5', 'groups' => 'general'],
            ['name' => 'site_fav_icon', 'title' => 'Site Favicon', 'value' => '', 'type' => 'image', 'options' => '', 'description' => '', 'sorting_number' => '6', 'groups' => 'general'],
            ['name' => 'site_logo', 'title' => 'Site Logo', 'value' => '', 'type' => 'image', 'options' => '', 'description' => '', 'sorting_number' => '7', 'groups' => 'general'],
        ];
        foreach ($settings as $setting) {
            DB::table('settings')->insert($setting);
        }
    }
}
