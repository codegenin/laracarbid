<?php

declare(strict_types=1);

return [

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \App\Models\Subscription\Plan::class,
        'plan_feature' => \App\Models\Subscription\PlanFeature::class,
        'plan_subscription' => \App\Models\Subscription\PlanSubscription::class,
        'plan_subscription_usage' => \App\Models\Subscription\PlanSubscriptionUsage::class,

    ],

];
