<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use Notifiable;
    
    protected $fillable = ['name', 'password', 'phoneNumber'];
    protected $hidden = ['password'];

    protected function casts(): array{
        return [
            'password' => 'hashed',
        ];
    }
}
