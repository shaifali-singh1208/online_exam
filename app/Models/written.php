<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class written extends Model
{
    use HasFactory;
    protected $table="writing_answer";
    protected $primarykey="id";

protected $fillable = ['t1_ans', 't2_ans', 'test_id','user_id','celpip_test_id'];
}