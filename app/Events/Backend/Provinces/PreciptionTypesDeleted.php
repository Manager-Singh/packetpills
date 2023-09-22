<?php

namespace App\Events\Backend\Provinces;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugDeleted.
 */
class ProvincesDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $provinces;

    /**
     * @param $enterpriseConnect
     */
    public function __construct($province)
    {
        $this->province = $province;
    }
}
