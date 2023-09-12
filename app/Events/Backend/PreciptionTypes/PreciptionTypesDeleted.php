<?php

namespace App\Events\Backend\PreciptionTypes;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugDeleted.
 */
class PreciptionTypesDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $preciptionType;

    /**
     * @param $enterpriseConnect
     */
    public function __construct($preciptionType)
    {
        $this->preciptionType = $preciptionType;
    }
}
