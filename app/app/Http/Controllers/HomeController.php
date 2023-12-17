<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $totalReminder = Reminder::count();
        $totalUser = User::count();
        $reminders = Reminder::orderBy('remind_at', 'desc')->take(5)->get();

        return view('dashboard', get_defined_vars());
    }
}
