<?php

namespace App\Events\Backend\MailMessages;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugDeleted.
 */
class MailMessagesDeleted
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
