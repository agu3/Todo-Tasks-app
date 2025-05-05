<?php

// app/Models/Task.php

// app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'user_id', 'priority_id', 'completed_at', 'status'];

    public function priority()
    {
        return $this->belongsTo(Priority::class);  // Relație many-to-one
    }

    public function isCompleted()
    {
        return !is_null($this->completed_at);
    }
}

