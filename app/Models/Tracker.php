<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Tracker extends Model
    {
        use HasFactory;
        use UUID;

        protected $fillable = [
            'description',
            'document_id',
            'account_id',
            'is_read'
        ];

    }
