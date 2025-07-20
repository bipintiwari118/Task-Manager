<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'priority',
        'created_by',
        'assigned_to',
        'assigned_date',
        'completed_date',
    ];
}
