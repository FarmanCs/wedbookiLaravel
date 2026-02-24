<?php

namespace Database\Seeders\Content;

use App\Models\Content\CmsSettings;
use Illuminate\Database\Seeder;

class CmsSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Create default CMS settings if not exists
        CmsSettings::firstOrCreate(
            ['id' => 1],
            [
                'site_name' => 'WedBooki',
                'site_email' => 'info@wedbooki.com',
                'default_timezone' => 'UTC',
                'default_language' => 'en',
                'currency' => 'USD',
            ]
        );
    }
}