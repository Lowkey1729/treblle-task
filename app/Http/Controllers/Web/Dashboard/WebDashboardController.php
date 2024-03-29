<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class WebDashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard/Index');
    }
}
