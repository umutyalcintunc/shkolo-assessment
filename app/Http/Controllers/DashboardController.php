<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(): \Inertia\Response|\Inertia\ResponseFactory
    {
        // Retrieve user's buttons
        $buttons = \App\Models\Button::where('user_id', auth()->id())->get();

        // Render the view with buttons as props
        return inertia('Dashboard', [
            'buttons' => $buttons,
        ]);
    }

}
