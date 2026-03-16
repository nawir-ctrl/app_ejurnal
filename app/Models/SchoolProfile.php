<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'npsn',
        'address',
        'city',
        'logo_path',
        'academic_year',
        'principal_name',
        'principal_nip',
        'treasurer_name',
        'treasurer_nip',
    ];
}