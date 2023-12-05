<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Favourite_document extends Model
    {
        use HasFactory;
        use UUID;

        protected $fillable = [
            'document_id',
            'account_id',
        ];

    }
