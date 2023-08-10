<?php

namespace App\Events\Backend\Drugs;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugUpdated.
 */
class DrugUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $drugs;

    /**
     * @param $drugs
     */
    public function __construct($drugs)
    {
        $this->drugs = $drugs;
    }
}
