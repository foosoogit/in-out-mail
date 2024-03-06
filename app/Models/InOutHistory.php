<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class InOutHistory extends Model
{
    use HasFactory;
    public $week = array( "日", "月", "火", "水", "木", "金", "土" );

    protected $fillable = [
        'student_serial',
        'target_date',
        'time_in',
        'time_out',
        'student_name',
        'student_name_kana',
        'to_mail_address',
        'from_mail_address',
    ];

    public function getWeekAttribute($value){
		$wk='('.$this->week[date("w", strtotime($this->target_date))].')';
		return $wk;
	}

    public function getOnlyTimeInAttribute($value){
		$TI=date('H:i:s', strtotime($this->time_in));
		return $TI;
	}

    public function getOnlyTimeOutAttribute($value){
		if(empty($this->time_out)){
            $TI='';
        }else{
            $TI=date('H:i:s', strtotime($this->time_out));
        }
		return $TI;
	}
}
