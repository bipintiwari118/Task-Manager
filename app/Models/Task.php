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
        'images',
        'status_id',
        'priority',
        'created_by',
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

    public function creator(){
             return $this->belongsTo(User::class, 'created_by');
        }

// Assigned users (many-to-many)
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id')->withTimestamps();
    }


    public function status() {
            return $this->belongsTo(Status::class);
        }

        protected $casts = [
         'images' => 'array',
        ];
}
