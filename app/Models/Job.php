<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Job extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'department_id',
        'title',
        'description',
        'minimum_basic',
        'maximum_basic'
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
        ];
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function employees() {
        return $this->hasMany(Employee::class);
    }
}
