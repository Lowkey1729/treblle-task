<?php

namespace App\Http\Controllers\Web\User;

use App\Exceptions\UserError;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Contracts\User\UserInterface;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected readonly UserInterface $user)
    {
    }

    public function viewUserDetails(string $uuid): RedirectResponse
    {
        try {
            $this->user->viewUserDetails($uuid);
        } catch (UserError $error) {
            return redirect()->back()->with('error', $error->getMessage());
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An unexpected error was encountered');
        }

        return redirect('/');
    }

    public function updateUserDetails(string $uuid, UpdateUserRequest $request): RedirectResponse
    {
        try {
            $this->user->editUserDetails($uuid, $request->validated());
        } catch (UserError $error) {
            return redirect()->back()->with('error', $error->getMessage());
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An unexpected error was encountered');
        }

        return redirect('/');
    }

}
