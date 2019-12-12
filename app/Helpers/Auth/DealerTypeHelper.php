<?php

namespace App\Helpers\Auth;

/**
 * Class DealerTypeHelper.
 */
class DealerTypeHelper
{
    /**
     * List of the accepted dealer types for validation
     * @return array
     */
    public function validateDealerTypes(): array
    {
        return [
            'franchise',
            'independent',
            'bank',
            'wholesale',
            'other',
        ];
    }

    /**
     * List of dealer types can be used for dropdown
     *
     * @return array
     */
    public function getDealerTypes(): array
    {
        return [
            'franchise'   => 'Francise Dealer',
            'independent' => 'Independent Dealer',
            'bank'        => 'Bank Owned',
            'wholesale'   => 'Wholesale Dealer',
            'other'       => 'Other'
        ];
    }
}
