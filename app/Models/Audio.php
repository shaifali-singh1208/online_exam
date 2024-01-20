<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    protected $table = 'audio';
    protected $fillable = ['question_ids', 'time', 'audio_link' ];


   
    
}
