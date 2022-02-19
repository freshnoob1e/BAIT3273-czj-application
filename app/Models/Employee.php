<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'image',
        'job_id',
        'employee_id',
        'name',
        'date_joined',
        'qualification',
        'work_type',
        'basic_salary',
        'contact_number',
        'email',
        'birth_date'
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'qualification' => $this->qualification,
            'basic_salary' => $this->basic_salary,
            'contact_number' => $this->contact_number,
            'email' => $this->email
        ];
    }

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function address() {
        return $this->hasOne(Address::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
