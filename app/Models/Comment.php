<?php

namespace App\Models;

use App\Helpers\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'description',
        'content_id',
        'account_id',
        'document_id'
    ];
}
