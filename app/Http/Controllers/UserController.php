<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('welcome');
    }
    public function emailVerify(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!empty($user)) {
            session(['user_id' => $user->id]);
            if (isset($request->user)) {
                return redirect()->route('dashboard', [$user]);
            } else {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->back()->with('error', 'ایمیل وارد شده وجود ندارد');
        }
    }

    public function dashboard($id)
    {
        $user = User::find($id);

        $wallet = $user->wallets;

        $sentTransactions = $user->sentTransactions()->get();
        $receivedTransactions = $user->receivedTransactions()->get();

        $transactions = $sentTransactions->map(function ($transaction) {
            $transaction->type = 'Sent';
            $transaction->related_user = $transaction->receiverWallet->user;
            return $transaction;
        })->merge(
            $receivedTransactions->map(function ($transaction) {
                $transaction->type = 'Received';
                $transaction->related_user = $transaction->senderWallet->user;
                return $transaction;
            })
        )->sortByDesc('created_at')->take(2);
        return view('dashboard', compact('user', 'wallet', 'transactions'));
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect()->route('index');
    }

}
