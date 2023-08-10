<?php

namespace App\Events\Backend\Drugs;

use Illuminate\Queue\SerializesModels;

/**
 * Class BlogCreated.
 */
class DrugCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $drugs;

    /**
     * @param $blogs
     */
    public function __construct($drugs)
    {
        $this->drugs = $drugs;
    }
}
