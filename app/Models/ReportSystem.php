<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSystem extends Model
{
    use HasFactory;
    protected $table = 'report_systems';
    protected $fillable =
        [
            'uuid',
            'type',
            'receiver_report_id',
            'role',
            'date',
            'time',
            'row',
            'status'
        ];
}
