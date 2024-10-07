<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        // $user = User::find(1);

        // $user = User::query()->create([
        //     'name' => 'Lucas',
        //     'email' => 'lucas@email.com',
        //     'password' => '123',
        // ]);

        // $user->email_verified_at = now();

        // $user->save();

        // $user->update(['email_verified_at' => now()]);

        // $user->email_verified_at = now();

        // $user->save();

        // $user->update([
        //     // 'id' => 10,
        //     'email_verified_at' => now()->subMonths(10),
        // ]);

        // dd($user->email_verified_at->diffForHumans());

        // Auth::login($user);
        // Auth::logout();

        return view('teste.jeremias');

    }
}
