<?php

namespace App\Events\Backend\AutoMessages;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCreated.
 */
class AutoMessagesCreated
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
