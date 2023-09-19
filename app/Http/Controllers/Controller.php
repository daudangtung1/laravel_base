<?php

namespace App\Http\Controllers;

use App\AppMain\Utils\TransactionHelper;
use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\AppMain\Config\AppConst;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ApiResponseTrait;

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

    protected function baseAction(Closure $closure, $messageSuccess = 'Success', $messageError = 'Error', ...$params)
    {
        try {
            $result = $closure();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return $this->responseJsonFail(AppConst::CODE_EXCEPTION_MESSAGE == $e->getCode() ? $e->getMessage() :  __($messageError));
        }

        return ($result || is_array($result)) ? $this->responseJsonSuccess($result, __($messageSuccess)) : $this->responseJsonFail(__($messageError));
    }

    protected function baseActionTransaction(Closure $closure, $messageSuccess = 'Success', $messageError = 'Error', ...$params)
    {
        try {
            $this->transactionStart();
            $result = $closure();
            $this->transactionComplete();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return $this->responseJsonFail(AppConst::CODE_EXCEPTION_MESSAGE == $e->getCode() ? $e->getMessage() :  __($messageError));
        }

        return $result ? $this->responseJsonSuccess($result, __($messageSuccess)) : $this->responseJsonFail(__($messageError));
    }
}
