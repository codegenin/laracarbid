<?php

use App\Models\Vehicle\VehicleCategory;
use Illuminate\Database\Seeder;

/**
 * Class VehicleCategoryTableSeeder.
 */
class VehicleCategoryTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Categories
        $categories = [
            'SEDAN',
            'SUV',
            'MPV',
            'VAN',
            'TRUCK',
            'HATCHBACK',
            'CROSSOVER',
            'COUPE',
            'CONVERTIBLE'
        ];

        foreach ($categories as $category) {
            VehicleCategory::create([
                'title' => $category,
                'description' => strtolower($category),
            ]);
        }

        $this->enableForeignKeys();
    }
}
