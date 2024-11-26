<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Trait\ResponseTrait;
use App\Helpers\TransactionHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ResponseTrait;

    protected $transactionHelper;

    public function __construct()
    {
        $this->transactionHelper = TransactionHelper::getInstance();
    }

    public function transactionStart($connection = null)
    {
        $this->transactionHelper->start($connection);
    }

    public function transactionComplete()
    {
        $this->transactionHelper->complete();
    }

    public function transactionStop()
    {
        $this->transactionHelper->stop();
    }
}
