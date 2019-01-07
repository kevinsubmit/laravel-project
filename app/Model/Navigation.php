<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Navigation extends Model
{
    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'navigation';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'n_id';

    public function scopenavigation_info($query){
        $query;
    }
}