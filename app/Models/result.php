<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Result extends Model
{
    use HasFactory;

    protected $table = 'result';
    protected $primaryKey = 'id';
    protected $fillable = ['w_bands','s_bands','l_bands','r_bands','writing_test_id','speaking_test_id','celpip_test_id','test_id','overall_bands']; // Add 'w_bands' to the $fillable array
}
