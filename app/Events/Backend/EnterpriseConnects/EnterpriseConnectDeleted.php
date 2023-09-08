<?php

namespace App\Events\Backend\EnterpriseConnects;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugDeleted.
 */
class EnterpriseConnectDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $enterpriseConnect;

    /**
     * @param $enterpriseConnect
     */
    public function __construct($enterpriseConnect)
    {
        $this->enterpriseConnect = $enterpriseConnect;
    }
}
