<?php

namespace App\Events\Backend\MailMessages;

use Illuminate\Queue\SerializesModels;

/**
 * Class DrugUpdated.
 */
class MailMessagesUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $autoMessage;

    /**
     * @param $drugs
     */
    public function __construct($autoMessage)
    {
        $this->autoMessage = $autoMessage;
    }
}
