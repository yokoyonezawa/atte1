<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stamp;
use App\Models\WorkBreak;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{

    public function store(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        return redirect('stamp');
    }

    public function index(){
        $user = Auth::user();
        return view('stamp', compact('user'));
    }



    public function start(Request $request)
    {
        $stamp = new Stamp();
        $stamp->user_id = Auth::id();
        $stamp->start_time = Carbon::now();
        $stamp->save();

        return redirect('/stamp');
    }

    public function end(Request $request)
    {
        $stamp = Stamp::where('user_id', Auth::id())->latest()->first();
        $stamp->end_time = Carbon::now();
        $stamp->save();

        return redirect('/stamp');
    }


    public function startBreak(Request $request)
    {
        $stamp = Stamp::where('user_id', Auth::id())->latest()->first();
        $break = new WorkBreak();
        $break->stamp_id = $stamp->id;
        $break->start_time = Carbon::now();

        $break->save();

        return redirect('/stamp');
    }

    public function endBreak(Request $request)
    {
        $stamp = Stamp::where('user_id', Auth::id())->latest()->first();
        $break = WorkBreak::where('stamp_id', $stamp->id)->whereNull('end_time')->latest()->first();
        if ($break) {
            $break->end_time = Carbon::now();
            $break->save();
        }

        return redirect('/stamp');
    }

    public function attendance(Request $request)
{
    $date = Carbon::parse($request->input('date', Carbon::today()->toDateString()));

    $previousDate = $date->copy()->subDay()->toDateString();
    $nextDate = $date->copy()->addDay()->toDateString();

    $stamps = Stamp::with(['user', 'breaks'])
        ->where(function ($query) use ($date) {
            $query->whereDate('start_time', $date)
            ->orWhere(function ($query) use ($date) {
                $query->whereDate('end_time', $date);
            });
        })
        ->paginate(5);

    return view('attendance', compact('stamps', 'date', 'previousDate', 'nextDate'));
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}