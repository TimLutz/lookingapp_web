<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShareAlbumModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='share_albums';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'sender_id','receiver_id','is_received','is_view','album'
    ];
    
    

   


}