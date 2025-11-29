<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    protected $fillable = [
        'candidate_id',
        'nisn',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'religion',
        'address',
        'phone',
        'father_name',
        'mother_name',
        'profile_picture',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
