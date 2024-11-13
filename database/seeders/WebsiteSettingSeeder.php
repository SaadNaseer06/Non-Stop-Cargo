<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new = new WebsiteSetting;
        $new->address = "Lorem Ipsum";
        $new->number = "+92631215616515";
        $new->email = "help@gmail.com";
        $new->facebook = "https://www.facebook.com/";
        $new->instagram = "https://www.instagram.com/";
        $new->twitter = "https://twitter.com/?lang=en";
        $new->linkedin = "https://pk.linkedin.com/";
        $new->save();
    }
}
