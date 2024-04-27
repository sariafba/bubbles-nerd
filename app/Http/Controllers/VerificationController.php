<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\EmailVerificationRequest;
use App\Http\Requests\Auth\ResendEmailVerificationRequest;
use App\Services\VerificationService;
use Illuminate\Http\Request;
use NextApps\VerificationCode\VerificationCode;

class VerificationController extends Controller
{
    protected VerificationService $verificationService;

    public function __construct(VerificationService $verificationService)
    {
        $this->verificationService = $verificationService;
    }


    public function emailVerification(EmailVerificationRequest $request)
    {
        return $this->verificationService->emailVerification($request->safe()->all());
    }

    public function resendEmailVerification(ResendEmailVerificationRequest $request)
    {
        return $this->verificationService->resendEmailVerification($request->safe()['email']);
    }
}
