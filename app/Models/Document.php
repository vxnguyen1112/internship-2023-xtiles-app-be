<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Document extends Model
    {
        use HasFactory;
        use UUID;

        protected $fillable = [
            'name',
            'is_deleted',
            'img_cover_url',
            'img_panel_url',
            'account_id',
            'workspace_id'
        ];

    }
