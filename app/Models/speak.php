<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class speak extends Model
{
    use HasFactory;
    protected $table = "speaking_answer";
    protected $primaryKey = "id";
    protected $fillable = ['a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'test_id', 'user_id','celpip_test_id'];
}
