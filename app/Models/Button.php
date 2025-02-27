<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Button extends Model
{
    protected $fillable = [
        'user_id',
        'label',
        'color',
        'link',
    ];

}
