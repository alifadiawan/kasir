<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class item extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'name',
    //     'price',
    //     'stock'
    // ];
    protected $table = 'items';

    protected $guarded = [];

    public $timestamps = false;

    public function category(){
        return $this->belongsTo(category::class);
    }

    public function cart(){
        return $this->hasOne(cart::class);
    }

    public function transaction(){
        return $this->hasManyThrough(transaction::class, transactiondetail::class);
    }

    // public function reservasi(){
    //     return $this->belongsTo('App\Models\items', 'items');
    // }

    
}
