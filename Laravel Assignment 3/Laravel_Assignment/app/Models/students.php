<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;

    // Specify that 'id' is the primary key
    protected $primaryKey = 'id';

    // Disable auto-increment for 'id'
    public $incrementing = false;

    protected $fillable = ['id',
                             'email',
                              'password'];
}

