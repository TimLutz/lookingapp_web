<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $collection='jobseeker_review_questions';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'question','status','show_to_whom','type_of_question','option',
    ];
    
    

   


}
