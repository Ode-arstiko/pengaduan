<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_photos extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report() {
        return $this->belongsTo(Reports::class, 'report_id', 'id');
    }

    public function photoNotifs() {
        return $this->hasMany(Notifications::class, 'report_id', 'report_id');
    }
}
