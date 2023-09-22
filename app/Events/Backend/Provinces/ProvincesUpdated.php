<?php

namespace App\Events\Backend\Provinces;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugUpdated.
 */
class ProvincesUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $provinces;

    /**
     * @param $drugs
     */
    public function __construct($provinces)
    {
        $this->provinces = $provinces;
    }
}
