<?php

namespace App\Models;

use App\Helpers\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'title',
        'color',
        'position',
        'size',
        'is_title_hidden',
        'page_id'
    ];
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
