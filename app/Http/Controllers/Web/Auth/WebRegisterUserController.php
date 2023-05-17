<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Contracts\Auth\RegisterInterFace;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class WebRegisterUserController extends Controller
{
    public function __construct(protected readonly RegisterInterFace $register)
    {
    }

    public function registerForm(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function registerUser(RegisterRequest $request): RedirectResponse
    {
        try {
            $this->register->registerUser($request->validated());
        } catch (\Exception $exception) {
            Log::error($exception);

            return redirect()->back()->with('error', 'An unexpected error was encountered.');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
