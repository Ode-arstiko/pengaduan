<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_photos extends Model
{
    protected $fillable = ['chat_id', 'photo_url'];

    public function chat()
    {
        return $this->belongsTo(Chats::class, 'chat_id');
    }
}
