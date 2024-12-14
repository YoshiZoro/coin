<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function wallets()
    {
        return $this->hasOne(Wallet::class);
    }

    public function sentTransactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class, 'user_id', 'sender_wallet_id', 'id', 'id');
    }

    public function receivedTransactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class, 'user_id', 'receiver_wallet_id', 'id', 'id');
    }



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token'
    ];
}
