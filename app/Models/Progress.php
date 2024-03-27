<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $with = ['user'];
    
    protected $fillable = [
        'poids',
        'taille',
        'age',
        'chest',
        'bicep',
        'leg',


    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
