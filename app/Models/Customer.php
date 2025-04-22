<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'id',
        'user_id', 
        'google_id', 
        'google_token', 
        'alamat', 
        'pos', 
        'nama', 
        'email', 
        'status', 
        'role', 
        'password', 
        'hp', 
        'foto', 
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            if ($customer->user) {
                $customer->user->delete();
            }
        });
    }
}
