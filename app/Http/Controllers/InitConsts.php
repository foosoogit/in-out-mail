<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\configration;

class InitConsts extends Controller
{
    public static function CourceArray(){
        $Tcource=configration::where('subject','=','Course')->first();
        $course_array=explode(",", $Tcource->value1);
        return $course_array;
    }

    public static function DdisplayLineNumStudentsList(){
        $inits_array=configration::where('subject','=','DdisplayLineNumStudentsList')->first();
        return $inits_array->value1;
    }

    public static function GradeArray(){
        $Tgrade=configration::where('subject','=','Grade')->first();
        $grade_array=explode(",", $Tgrade->value1);
        return $grade_array;
    }

    public static function JyukuName(){
        $res=configration::where('subject','=','JyukuName')->first('value1');
        return $res['value1'];
    }

    public static function Interval(){
        $res=configration::where('subject','=','Interval')->first('value1');
        return $res['value1'];
    }

    public static function sbjIn(){
        $res=configration::where('subject','=','sbjIn')->first();
        return $res['value1'];
    }
    
    public static function MsgIn(){
        $res=configration::where('subject','=','MsgIn')->first('value1');
        return $res['value1'];
    }
    
    public static function sbjOut(){
        $res=configration::where('subject','=','sbjOut')->first('value1');
        return $res['value1'];
    }
    public static function MsgOut(){
        $res=configration::where('subject','=','MsgOut')->first('value1');
        return $res['value1'];
    }
    public static function MsgTest(){
        $res=configration::where('subject','=','MsgTest')->first('value1');
        return $res['value1'];
    }
    public static function MsgFooter(){
        $res=configration::where('subject','=','MsgFooter')->first('value1');
        return $res['value1'];
    }
    public static function sbjTest(){
        $res=configration::where('subject','=','sbjTest')->first('value1');
        return $res['value1'];
    }

    public static function getValue($tagetSbj){
        $res=configration::where('subject','=',$tagetSbj)->first('value1');
        return $res['value1'];
    }

    
}
