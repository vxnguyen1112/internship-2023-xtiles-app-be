<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Page extends Model
    {
        use HasFactory;
        use UUID;

        protected $fillable = [
            'name',
            'document_id'
        ];

        public function blocks()
        {
            return $this->hasMany(Block::class);
        }

        protected $hidden = ['document'];
        protected $touches = ['document'];

        public function document(): BelongsTo
        {
            return $this->belongsTo(Document::class);
        }
    }
