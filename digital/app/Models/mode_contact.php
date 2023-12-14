<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mode_contact extends Model
{
    use HasFactory;
    protected $table = 'contact';

    protected $fillable = [
        'username',
        'email',
        'massage',
    ];
}
