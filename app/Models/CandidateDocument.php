<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateDocument extends Model
{
    protected $fillable = [
        'candidate_id',
        'file_type',
        'file_path',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
