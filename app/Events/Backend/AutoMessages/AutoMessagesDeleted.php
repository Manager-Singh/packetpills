<?php

namespace App\Events\Backend\AutoMessages;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugDeleted.
 */
class AutoMessagesDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $autoMessage;

    /**
     * @param $enterpriseConnect
     */
    public function __construct($autoMessage)
    {
        $this->autoMessage = $autoMessage;
    }
}
