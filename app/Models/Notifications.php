<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function report() {
        return $this->belongsTo(Reports::class, 'report_id', 'id');
    }

    public function report_photo() {
        return $this->belongsTo(Report_photos::class, 'report_id', 'report_id');
    }

    public function chat() {
        return $this->belongsTo(Chats::class, 'chat_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
