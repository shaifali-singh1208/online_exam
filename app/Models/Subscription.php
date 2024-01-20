<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table='subscription';
    protected $primarykey='id';


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'subscription_id');
    }
}
