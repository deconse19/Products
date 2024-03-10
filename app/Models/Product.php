<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description'
    ];

    public function users(){


        return $this->belongsToMany(User::class);
    }
    public function companies(){


        return $this->belongsToMany(Company::class);
    }
}
    
    
