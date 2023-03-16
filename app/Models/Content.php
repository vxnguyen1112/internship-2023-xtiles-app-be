<?php

namespace App\Models;

use App\Helpers\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'name',
        'position',
        'type',
        'style',
        'store_url',
        'checked',
        'block_id'
    ];
}
