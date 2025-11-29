<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'user_id',
        'registration_number',
        'level',
        'major',
        'status',
        'exam_date',
    ];

    protected $casts = [
        'exam_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->hasOne(CandidateProfile::class);
    }

    public function documents()
    {
        return $this->hasMany(CandidateDocument::class);
    }
}
