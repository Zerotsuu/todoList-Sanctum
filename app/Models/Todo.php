<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id', // Assuming you want to track the user who created the todo
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'status' => 'boolean',
        ];
    }

    public function user()
    {
        // Return the user that owns the todo item
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        // Return the group that this todo belongs to
        return $this->belongsTo(TodoGroup::class);
    }
}
