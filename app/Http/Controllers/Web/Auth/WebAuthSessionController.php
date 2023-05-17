<?php

namespace App\Http\Controllers\Web\Auth;

use App\Exceptions\AuthError;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Contracts\Auth\AuthInterface;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class WebAuthSessionController extends Controller
{
    public function __construct(protected readonly AuthInterface $auth)
    {
    }

    public function loginForm(): Response
    {
        return Inertia::render('Auth/Login');
    }

    public function loginUser(LoginRequest $request): RedirectResponse
    {
        try {
            $this->auth->authenticateUser($request->validated());
        } catch (AuthError $error) {
            return redirect()->back()->with('error', $error->getMessage());
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An unexpected error was encountered');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function logoutUser(): RedirectResponse
    {
        try {
            $this->auth->logoutUser();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An unexpected error was encountered');
        }

        return redirect(route('auth.login-form'))->with('success', 'User logged out successfully.');

    }
}
