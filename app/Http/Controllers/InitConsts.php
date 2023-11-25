<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configration;

class InitConsts extends Controller
{
    public static function CourceArray(){
        $Tcource=Configration::where('subject','=','Course')->first();
        $course_array=explode(",", $Tcource->value1);
        return $course_array;
    }

    public static function DdisplayLineNumStudentsList(){
        $inits_array=Configration::where('subject','=','DdisplayLineNumStudentsList')->first();
        return $inits_array->value1;
    }

    public static function GradeArray(){
        $Tgrade=Configration::where('subject','=','Grade')->first();
        $grade_array=explode(",", $Tgrade->value1);
        return $grade_array;
    }

    public static function JyukuName(){
        $res=Configration::where('subject','=','JyukuName')->first('value1');
        return $res['value1'];
    }

    public static function Interval(){
        $res=Configration::where('subject','=','Interval')->first('value1');
        return $res['value1'];
    }

    public static function sbjIn(){
        $res=Configration::where('subject','=','sbjIn')->first();
        return $res['value1'];
    }
    
    public static function MsgIn(){
        $res=Configration::where('subject','=','MsgIn')->first('value1');
        return $res['value1'];
    }
    
    public static function sbjOut(){
        $res=Configration::where('subject','=','sbjOut')->first('value1');
        return $res['value1'];
    }
    public static function MsgOut(){
        $res=Configration::where('subject','=','MsgOut')->first('value1');
        return $res['value1'];
    }
    public static function MsgTest(){
        $res=Configration::where('subject','=','MsgTest')->first('value1');
        return $res['value1'];
    }
    public static function MsgFooter(){
        $res=Configration::where('subject','=','MsgFooter')->first('value1');
        return $res['value1'];
    }
    public static function sbjTest(){
        $res=Configration::where('subject','=','sbjTest')->first('value1');
        return $res['value1'];
    }

    public static function getValue($tagetSbj){
        $res=Configration::where('subject','=',$tagetSbj)->first('value1');
        return $res['value1'];
    }

    
}
