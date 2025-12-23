<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function reporter() {
        return $this->belongsTo(User::class, 'reporter_id', 'id');
    }

    public function target() {
        return $this->belongsTo(User::class, 'target_user_id', 'id');
    }

    public function photos() {
        return $this->hasMany(Report_photos::class, 'report_id', 'id');
    }

    public function chats() {
        return $this->hasMany(Chats::class, 'report_id', 'id');
    }
}
