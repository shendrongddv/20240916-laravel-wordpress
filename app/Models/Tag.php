<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function todos()
    {
        return $this->belongsToMany(Tag::class, 'tag_todos', 'tag_id', 'todo_id');
    }
}
