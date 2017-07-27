<?php

namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class NotificationModel extends Eloquent
{
    // Specify the table name.
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =  [	'from',
    							'to',
    							'status',
					          	'type',
                                'title',
					          	'created_at' ,
            					'updated_at'
                            ];
}
