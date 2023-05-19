<?php

namespace App\Http\Controllers\Web\Auth;

use App\Exceptions\PasswordError;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordRequest;
use App\Services\Contracts\Auth\PasswordInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class WebPasswordController extends Controller
{
    public function __construct(protected readonly PasswordInterface $password)
    {
    }

    public function updatePassword(PasswordRequest $request): RedirectResponse
    {
        try {
            $this->password->updatePassword(\request()->user(), $request->validated());
        } catch (PasswordError $error) {
            return redirect()->back()->with('error', $error->getMessage());
        } catch (\Exception $exception) {
            Log::error($exception);

            return redirect()->back()->with('error', 'An unexpected error was encountered.');
        }

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
