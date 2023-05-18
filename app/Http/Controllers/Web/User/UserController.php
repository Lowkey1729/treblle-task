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
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(protected readonly UserInterface $user)
    {
    }

    public function viewUserDetails(): Response|RedirectResponse
    {
        try {
            $user = $this->user->viewUserDetails(\request()->user());
        } catch (UserError $error) {
            return redirect()->back()->with('error', $error->getMessage());
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An unexpected error was encountered');
        }

        return Inertia::render('User/Edit', [
            'user' => $user
        ]);
    }

    public function updateUserDetails(UpdateUserRequest $request): RedirectResponse
    {
        try {
            $this->user->editUserDetails(\request()->user(), $request->validated());
        } catch (UserError $error) {
            return redirect()->back()->with('error', $error->getMessage());
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'An unexpected error was encountered');
        }

        return redirect()->back()->with('success', 'User details updated successfully');
    }

}
