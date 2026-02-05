<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fakultet extends Model
{
     protected $table = 'fakulteti';

    protected $fillable = ['naziv', 'mjesto'];

    public function studenti(): HasMany
    {
        return $this->hasMany(Student::class, 'fakultetid');
    }
}
