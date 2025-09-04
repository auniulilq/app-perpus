<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBorrows extends Model
{
    //
    protected $fillable =[
        'id_borrow',
        'id_book',

    ];

    //realtion orm ke table borrows
    public function borrow()
    {
        return $this->belongsTo(Borrows::class,'id_borrow','id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class,'id_book','id');
    }
}
