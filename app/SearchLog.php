<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $table = 'user_history';
    public $timestamps = false;

    protected $fillable = [
    	'user_id','ip_address','searches','search_time'
    ];

    public static function log($data = []){
    	static::create($data);
    	return true;
    }
}

