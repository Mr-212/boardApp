<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable = ['board_id','title','description'];

    public function board(){
        return $this->hasOne(Board::class,'board_id','id');
    }
}
