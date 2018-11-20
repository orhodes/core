<?php

namespace App\Models\Cts;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $connection = 'cts';
    protected $guarded = [];
    public const CREATED_AT = 'taken_time';
    public const UPDATED_AT = null;

    public function student()
    {
        return $this->belongsTo(Member::class, 'student_id', 'id');
    }

    public function mentor()
    {
        return $this->belongsTo(Member::class, 'mentor_id', 'id');
    }

}
