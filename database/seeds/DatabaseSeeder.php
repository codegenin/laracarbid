<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'cache',
            'failed_jobs',
            'ledgers',
            'jobs',
            'sessions',
            'vehicle_categories',
            'vehicles',
            'faqs'
        ]);

        $this->call(AuthTableSeeder::class);
        $this->call(VehicleCategoryTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(FaqTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        Model::reguard();
    }
}
