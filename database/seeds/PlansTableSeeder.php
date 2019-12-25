<?php

use Illuminate\Database\Seeder;

/**
 * Class PlansTableSeeder.
 */
class PlansTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'plans',
            'plan_subscriptions',
            'plan_subscription_usage',
            'plan_features'
        ]);

        $this->call(PlanTableSeeder::class);

        $this->enableForeignKeys();
    }
}
