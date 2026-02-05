<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
     protected $table = 'studenti';

    protected $fillable = [
        'ime', 'prezime', 'datum_rod', 'mbr', 'stipendija', 'mjesto', 'fakultetid'
    ];

    protected $casts = [
        'datum_rod' => 'date',
        'stipendija' => 'decimal:2',
    ];

    public function fakultet(): BelongsTo
    {
        return $this->belongsTo(Fakultet::class, 'fakultetid');
    }
}
