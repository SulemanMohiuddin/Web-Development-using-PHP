<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attends extends Model
{
    use HasFactory;
    protected $fillable = ['cid',
                             'sid',
                              'date',
                               'value'];
}
