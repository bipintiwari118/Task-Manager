<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Task extends Model
{
    use HasFactory;
    use Sluggable;

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


       public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

// The user who is assigned to do this task
public function assigne()
{
    return $this->belongsTo(User::class, 'assigned_to');
}
}
