<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stamp;

class RegisteredUserController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('stamp', compact('user'));
    }

    public function start(Request $request)
    {
        Stamp::updateOrCreate(
            ['user_id' => Auth::id()],
            ['start_time' => now()]
        );
        return redirect('/');
    }

    public function end(Request $request)
    {
        $stamp = Stamp::where('user_id', Auth::id())->first();
        $stamp->end_time = now();
        $stamp->save();

        return redirect('/');
    }

    public function startBreak(Request $request)
    {
        $stamp = Stamp::where('user_id', Auth::id())->first();
        $stamp->break_start_time = now();
        $stamp->save();

        return redirect('/');
    }

    public function endBreak(Request $request)
    {
        $stamp = Stamp::where('user_id', Auth::id())->first();
        $stamp->break_end_time = now();
        $stamp->save();

        return redirect('/');
    }
}
