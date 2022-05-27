<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class game extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =[
        'id', //Autoincrement
        'value1', //value dado 1 - integer
        'value2', //value dado 2 - integer
        'result' //winner (1) or loser (0) 
    ] ;
    /**
     * Get the user that owns the dado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
         return $this->belongsTo(User::class);  /* ,'foreign_key', 'other_key' */
    }
}
