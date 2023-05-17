<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['checkin', 'checkout', 'schedule_id'];
    public $timestamps = false;
    
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
