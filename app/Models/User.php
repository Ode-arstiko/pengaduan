<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Tambahkan ini agar Auth::attempt() pakai kolom username, bukan email
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function sentReports() {
        return $this->hasMany(Reports::class, 'reporter_id', 'id');
    }

    public function receivedReports() {
        return $this->hasMany(Reports::class, 'target_user_id', 'id');
    }

    public function senderChats() {
        return $this->hasMany(Chats::class, 'sender_id', 'id');
    }

    public function receiverChats() {
        return $this->hasMany(Chats::class, 'receiver_id', 'id');
    }
}
