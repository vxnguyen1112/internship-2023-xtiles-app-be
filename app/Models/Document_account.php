<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Document_account extends Model
    {
        use HasFactory;
        use UUID;

        protected $fillable = [
            'role',
            'account_id',
            'document_id',
            'is_accepted'
        ];

    }
