<?php

use App\Models\Vehicle\Category;
use Illuminate\Database\Seeder;

/**
 * Class CategoryTableSeeder.
 */
class CategoryTableSeeder extends Seeder
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
            Category::create([
                'title' => $category,
                'description' => strtolower($category),
            ]);
        }

        $this->enableForeignKeys();
    }
}
