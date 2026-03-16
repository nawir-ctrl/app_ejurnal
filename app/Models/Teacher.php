<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi One-to-Many: Satu Guru bisa memiliki banyak Jurnal.
     */
    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }
}