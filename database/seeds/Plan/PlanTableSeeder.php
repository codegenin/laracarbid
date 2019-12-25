<?php

use Illuminate\Database\Seeder;
use App\Models\Vehicle\VehicleCategory;
use Rinvex\Subscriptions\Models\PlanFeature;

/**
 * Class PlanTableSeeder.
 */
class PlanTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $planOne = app('rinvex.subscriptions.plan')->create([
            'name' => '$295',
            'description' => '1-10 Monthly Transactions',
            'price' => 295,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create plan feature
        $planOne->features()->saveMany([
            new PlanFeature(['name' => 'transaction_per_month', 'value' => 10, 'sort_order' => 1, 'resettable_period' => 1, 'resettable_interval' => 'month']),
        ]);

        $planTwo = app('rinvex.subscriptions.plan')->create([
            'name' => '$695',
            'description' => '1-35 Monthly Transactions',
            'price' => 695,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create plan feature
        $planTwo->features()->saveMany([
            new PlanFeature(['name' => 'transaction_per_month', 'value' => 35, 'sort_order' => 1, 'resettable_period' => 1, 'resettable_interval' => 'month']),
        ]);

        $planThree = app('rinvex.subscriptions.plan')->create([
            'name' => '$995',
            'description' => '1-10 Monthly Transactions',
            'price' => 995,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 0,
            'trial_interval' => 'day',
            'sort_order' => 1,
            'currency' => 'USD',
        ]);

        // Create plan feature
        $planThree->features()->saveMany([
            new PlanFeature(['name' => 'transaction_per_month', 'value' => 75, 'sort_order' => 1, 'resettable_period' => 1, 'resettable_interval' => 'month']),
        ]);


        $this->enableForeignKeys();
    }
}
