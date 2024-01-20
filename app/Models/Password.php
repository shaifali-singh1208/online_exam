<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;
    protected $table='password_resets';
    protected $primarykey = 'email';
    public $timestamps = false;
    protected $fillable = [
        'email', // Add any other fillable attributes here
        'token',
        'created_at',
    ];


}