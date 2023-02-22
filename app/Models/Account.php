<?php

    namespace App\Models;

    use App\Helpers\UUID;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Notifications\Notifiable;

    class Account extends Model
    {
        use  HasFactory, Notifiable;
        use UUID;

        protected $fillable = [
            'name',
            'email',
            'password',
            'avatar_url'

        ];
        protected $hidden = [
            'password'
        ];

        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        public function getJWTCustomClaims()
        {
            return [];
        }
    }
