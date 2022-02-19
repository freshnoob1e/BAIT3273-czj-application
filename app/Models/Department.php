<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Department extends Model
{
    use HasFactory, Searchable;

    protected $fillable=[
        'title'
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title
        ];
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
