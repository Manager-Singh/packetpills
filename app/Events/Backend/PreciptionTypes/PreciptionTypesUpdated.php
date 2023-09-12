<?php

namespace App\Events\Backend\PreciptionTypes;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugUpdated.
 */
class PreciptionTypesUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $preciptionType;

    /**
     * @param $drugs
     */
    public function __construct($preciptionType)
    {
        $this->preciptionType = $preciptionType;
    }
}
