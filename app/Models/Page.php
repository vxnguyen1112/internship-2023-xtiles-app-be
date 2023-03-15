<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Page extends Model
    {
        use HasFactory;
        use UUID;

        protected $fillable = [
            'name',
            'document_id'
        ];

    }
