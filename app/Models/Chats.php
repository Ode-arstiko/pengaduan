<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $fillable = [
        'report_id',
        'sender_id',
        'receiver_id',
        'message'
    ];

    public function photos()
    {
        return $this->hasMany(Chat_photos::class, 'chat_id');
    }

    public function report()
    {
        return $this->belongsTo(User::class, 'report_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
