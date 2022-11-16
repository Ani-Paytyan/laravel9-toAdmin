<?php

namespace App\Exceptions\Iwms;

use Illuminate\Support\Facades\Log;
use Throwable;


class IwmsApiError extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        Log::channel('apiErrLog')->error("Code: " . $this->code . " File:" . $this->file .  " Message: " . $this->getMessage());

        if ($request->ajax()) {
            return response()->json([
                'error' => $this->getMessage()
            ], $this->code);
        }

        return back()->with('toast_error', $this->getMessage(), $this->code);
    }
}
