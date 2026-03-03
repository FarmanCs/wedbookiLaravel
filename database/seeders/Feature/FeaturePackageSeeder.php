<?php

namespace Database\Seeders\Feature;

use App\Models\Business\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeaturePackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = Package::all();
        $features = \App\Models\Feature\Feature::all();
        $featureCount = $features->count();

        if ($featureCount === 0) {
            echo "⚠️ No features found. Skipping feature-package attachments.\n";
            return;
        }

        foreach ($packages as $package) {
            // Choose a random number between 1 and min(5, featureCount)
            $numberToAttach = rand(1, min(5, $featureCount));
            $randomFeatures = $features->random($numberToAttach)->pluck('id')->toArray();

            foreach ($randomFeatures as $featureId) {
                DB::table('feature_package')->insert([
                    'package_id' => $package->id,
                    'feature_id' => $featureId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
