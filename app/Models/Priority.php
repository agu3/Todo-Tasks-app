<?php
// app/Models/Priority.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'task_id'];  // Adăugăm task_id

    public function task()
    {
        return $this->belongsTo(Task::class);  // Relație many-to-one
    }
}
