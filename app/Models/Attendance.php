<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = ['id','user_id','date','sign_in_time','sign_out_time'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
