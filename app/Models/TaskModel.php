<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryTask;

class TaskModel extends Model
{
    use HasFactory;

    protected $table = 'tasks'; // Sesuaikan nama tabel dengan yang benar

    protected $fillable = ['title', 'description', 'priority', 'due_date', 'completed', 'completed_at'];

     public function category()
    {
        return $this->belongsTo(CategoryTask::class, 'category_id');
    }
}
