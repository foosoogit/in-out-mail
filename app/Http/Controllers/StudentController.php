<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStudentRequest;
use App\Mail\ContactMail;
use App\Models\InOutHistory;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{

    public function show_login_guest()
    {
        return view('guest.show_login_guest');
    }

    function update_JQ(Request $request)
    {
        Log::alert('gender='.$request->gender);
        $email_array=explode(",", $request->email);
        $protector_array=explode(",", $request->protector);
        /*
        $gender="";
        if(isset($request->gender)){
            $gender=implode( ",", $request->gender );
        }
        */
        Student::where('serial_student', '=', $request->serial_student)
            ->update([
                'email'=>$request->email,
                'name_sei'=>$request->name_sei,
                'name_mei'=>$request->name_mei,
                'name_sei_kana'=>$request->name_sei_kana,
                'name_mei_kana'=>$request->name_mei_kana,
                'protector'=>$request->protector,
                'pass_for_protector'=>$request->pass_for_protector,
                'gender'=>$request->gender,
                'phone'=>$request->phone,
                'grade'=>$request->grade,
                'elementary'=>$request->elementary,
                'junior_high'=>$request->junior_high,
                'high_school'=>$request->high_school,
                'note'=>$request->note,
                'course'=>$request->course,
            ]);
        if($request->type=="mail"){
            $stud_name=$request->name_sei." ".$request->name_mei;
            self::send_test_mail_to_protector($stud_name,$email_array,$protector_array);
            echo '送信しました。';
        }else{
            session()->flash('flash.modify', '登録しました。');
            echo '修正しました。';
        }
    }

    public function send_test_mail_to_protector($stud_name,$eml_ary,$ptt_ary)
    {
        $user = Auth::user();
        $target_item_array['from_email']=$user->email;
        $i=0;
        foreach($eml_ary as $emal){
            $msg=InitConsts::MsgTest();
            
            $msg=str_replace('[name-protector]', $ptt_ary[$i], $msg);
            $msg=str_replace('[name-student]', $stud_name, $msg);
            $msg=str_replace('[time]', date("Y-m-d H:i:s"), $msg);
            $msg=str_replace('[name-jyuku]', InitConsts::JyukuName(), $msg);
            $msg=str_replace('[footer]', InitConsts::MsgFooter(), $msg);
            $target_item_array['msg']=$msg;
            
            $sbj=InitConsts::sbjTest();
            $sbj=str_replace('[name-protector]', $ptt_ary[$i], $sbj);
            $sbj=str_replace('[name-student]', $stud_name, $sbj);
            $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
            $sbj=str_replace('[time]', date("Y-m-d H:i:s"), $sbj);
            $sbj=str_replace('[footer]', InitConsts::MsgFooter(), $sbj);
            $sbj=str_replace('[name-jyuku]', InitConsts::JyukuName(), $sbj);
            $target_item_array['subject']=$sbj;
            $target_item_array['to_email']=$emal;

            Mail::send(new ContactMail($target_item_array));
        }
    }

    public function ShowRireki(){
        return view('admin.ListStudents',compact("target_key"));
	}

    public function SendInOutMail(Request $request)
    {
        $content = Student::where('serial_student','=',$request->StudentSerial)->first();
        $content = $request->input('content'); 
        //$user = auth()->user();
	
    	Mail::to($user->email)->send(new ContactMail($content));
	// メール送信後の処理
    }
    
    public function destroy($StudentID)
    {
        $InOutquery=inouthistory::whereIn("student_serial", function($query) use($StudentID){
            $query->from("students")
            ->select("serial_student")
            ->where("id", "=", $StudentID);
        })->delete();

       //dd($InOutquery->toSql(), $InOutquery->getBindings());
       Student::find($StudentID)->delete();
       /*
       $student = Student::find($StudentID);
        $student->update([
            //'serial_student'=>$request->serial_student,
            'email'=>"",
            'name_sei'=>"",
            'name_mei'=>"",
            'name_sei_kana'=>"",
            'name_mei_kana'=>"",
            'protector'=>"",
            'gender'=>"",
            'phone'=>"",
            'grade'=>"",
            'note'=>"",
            'course'=>"",
        ]);
        */
        return back();
    }

    public function ShowStudentModifyList($stud_seraial){
		session(['serchKey' =>$stud_seraial]);
        $target_key=$stud_seraial;
        return view('admin.ListStudents',compact("target_key"));
	}
    public function ShowInputStudent(Request $request){
        session(['fromPage' => 'InputStudent']);
		$stud_inf=Student::where('serial_student','=',$request->StudentSerial_Btn)->first();
        $html_grade_slct=OtherFunc::make_html_grade_slct($stud_inf->grade);
        $html_course_ckbox=OtherFunc::make_html_course_ckbox($stud_inf->course);
        $html_gender_ckbox=OtherFunc::make_html_gender_ckbox($stud_inf->gender);
        $student_serial=$stud_inf->serial_student;
        $generator = new BarcodeGeneratorHTML();
        $barcode =$generator->getBarcode($student_serial, $generator::TYPE_CODE_128);
        $email_array=explode(",", $stud_inf->email);
        for ($i=0;$i<3;$i++){
            if(!isset( $email_array[$i])){
                $email_array[$i]=""; 
            }
        }
        $protector_array=explode(",", $stud_inf->protector);
        for ($i=0;$i<3;$i++){
            if(!isset($protector_array[$i])){
                $protector_array[$i]=""; 
            }
        }
        $mnge='modify';
        return view('admin.CreateStudent',compact("barcode","html_gender_ckbox","protector_array","email_array","html_course_ckbox","stud_inf","html_grade_slct","student_serial","mnge"));
	}
    
    public function store(StoreStudentRequest $request)
    {
        $course = implode( ",", $request->course );
        $protector = implode( ",", $request->protector_array );
        $email = implode( ",", $request->email_array );

        Student::create([
            'serial_student'=>$request->serial_student,
            'email'=>$email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'gender'=>$request->gender,
            'protector'=>$protector,
            'pass_for_protector'=>$request->pass_for_protector,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'grade'=>$request->grade,
            'elementary'=>$request->elementary,
            'junior_high'=>$request->junior_high,
            'high_school'=>$request->high_school,
            'note'=>$request->note,
            'course'=>$course,
        ]);
        $msg="登録しました。";
        $mnge='create';
        return view('admin.menu_after_student_store',compact("msg","mnge"));
    }

    public function ShowInputNewStudent(Request $request)
    {
        session(['registered_flg' => ""]);
        session(['unregistered_flg' => "checked"]);
        return view('admin.ListStudents');
        /*
        $targetgrade="";
        $html_grade_slct=OtherFunc::make_html_grade_slct($targetgrade);
        $TargetCource="";
        $html_course_ckbox=OtherFunc::make_html_course_ckbox($TargetCource);
        $protector_array=array();$email_array=array();
        for($i=0;$i<=2;$i++){
            $protector_array[$i]="";
            $email_array[$i]="";
        }
        $stud_inf=Student::whereNull('email')->orderby('id')->first();
        session(['StudentManage' => 'create']);
        $mnge='create';$barcode="";
        $html_gender_ckbox=OtherFunc::make_html_gender_ckbox("");
        //return view('admin.CreateStudent',compact("html_cource_ckbox","stud_inf","student_serial","html_grade_slct","mnge"));
        return view('admin.CreateStudent',compact("html_gender_ckbox","barcode","email_array","protector_array","html_course_ckbox","stud_inf","html_grade_slct","mnge"));
        */
    }

    public function edit(Student $Student)
    {
        session(['StudentManage' => 'modify']);
        return view('students.CreateStudent', ['Student' => $Student]);
    }
    
    function update(Request $request, $id)
    {
        $eml_ary=array();$ptt_ary=array();
        for($i=0;$i<=2;$i++){
            if($request->email_array[$i]<>""){
                $eml_ary[]=$request->email_array[$i];
            }
            if($request->protector_array[$i]<>""){
                $ptt_ary[]=$request->protector_array[$i];
            }
        }
        $email=implode( ",", $eml_ary );
        $protector=implode( ",", $ptt_ary);
        $course = implode( ",", $request->course );
        $gender="";
        if(isset($request->gender)){
            $gender=implode( ",", $request->gender );
        }
        $student = Student::find($id);
        $student->update([
            'email'=>$email,
            'name_sei'=>$request->name_sei,
            'name_mei'=>$request->name_mei,
            'name_sei_kana'=>$request->name_sei_kana,
            'name_mei_kana'=>$request->name_mei_kana,
            'protector'=>$protector,
            'pass_for_protector'=>$request->pass_for_protector,
            'gender'=>$gender,
            'phone'=>$request->phone,
            'grade'=>$request->grade,
            'elementary'=>$request->elementary,
            'junior_high'=>$request->junior_high,
            'high_school'=>$request->high_school,
            'note'=>$request->note,
            'course'=>$course,
        ]);
        if(isset($request->SendMsgToProtectorBtn)){
            $stud_name=$request->name_sei." ".$request->name_mei;
            self::send_test_mail_to_protector($stud_name,$eml_ary,$ptt_ary);
            $msg="送信しました。";
            $mnge='send_mail';
            session()->flash('flash.send', '送信しました。');
        }else{
            session()->flash('flash.modify', '登録しました。');
            $msg="修正しました。";
            $mnge='modify';
        }
        $serial=$student->serial_student;

        //ShowInputStudent.Modify
        //redirect()->route('students/ShowInputStudent');
        return redirect('students/ShowInputStudent');
        //return view('admin.menu_after_student_store',compact("msg","mnge","serial"));
    }
}