<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteModel extends Model
{
    //
    protected $table = 'notes';
    protected $fillable = ['user_id','note_user_id','note'];
}
