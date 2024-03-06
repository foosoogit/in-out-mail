<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\MessageBag;

class OtherFunc extends Controller
{
    public static function validateMail($tagetEmail){
		$target_array = array('mail'=>$tagetEmail);
		$validator = Validator::make($target_array,
			['mail' => 'email']
	);
		if($validator->fails()) {
			return $tagetEmail;
		}else{
			return null;
		}
	}

	public static function ConvertPlaceholder($target_txt,$type){
        $target_txt=str_replace('[name-jyuku]', InitConsts::JyukuName(), $target_txt);
        $target_txt=str_replace('[footer]', InitConsts::MsgFooter(), $target_txt);
		$target_txt=str_replace('[time]', date("Y-m-d H:i:s"), $target_txt);
        if($type=="body"){
			$target_txt=str_replace(array("\r\n","\r",PHP_EOL), "<br/>", $target_txt);
			$target_txt=str_replace(" ", "&nbsp;", $target_txt);
			$target_txt=str_replace("　", "&emsp;", $target_txt);
		}
		//Log::alert('target_txt='.$target_txt );
		return $target_txt;
	}

	public static function randomName() {
		$myoujiAry = array('佐藤', '鈴木', '高橋', '田中', '渡辺', '伊藤', '山本', '中村', '小林', '加藤', '吉田', '山田', '佐々木', '山口',
			'斎藤', '松本', '井上', '木村', '林', '清水', '山崎', '森', '阿部', '池田', '橋本', '山下', '石川', '中島', '前田', '藤田',
			'小川', '後藤', '岡田', '長谷川', '村上', '近藤', '石井', '齊藤', '坂本', '遠藤', '青木', '藤井', '西村', '福田', '太田', '三浦',
			'岡本', '松田', '中川', '中野', '原田', '小野', '田村', '竹内', '金子', '和田', '中山', '藤原', '石田', '上田', '森田', '原',
			'柴田', '酒井', '工藤', '横山', '宮崎', '宮本', '内田', '高木', '安藤', '谷口', '大野', '丸山', '今井', '高田', '藤本', '武田',
			'村田', '上野', '杉山', '増田', '平野', '大塚', '千葉', '久保', '松井', '小島', '岩崎', '桜井', '野口', '松尾', '野村', '木下',
			'菊地', '佐野', '大西', '杉本', '新井', '浜田', '菅原', '市川', '水野', '小松', '島田', '古川', '小山', '高野', '西田', '菊池',
			'山内', '西川', '五十嵐', '北村', '安田', '中田', '川口', '平田', '川崎', '飯田', '吉川', '本田', '久保田', '沢田', '辻', '関',
			'吉村', '渡部', '岩田', '中西', '服部', '樋口', '福島', '川上', '永井', '松岡', '田口', '山中', '森本', '土屋', '矢野', '広瀬',
			'秋山', '石原', '松下', '大橋', '松浦', '吉岡', '小池', '馬場', '浅野', '荒木', '大久保', '野田', '小沢', '田辺', '川村', '星野',
			'黒田', '堀', '尾崎', '望月', '永田', '熊谷', '内藤', '松村', '西山', '大谷', '平井', '大島', '岩本', '片山', '本間', '早川',
			'横田', '岡崎', '荒井', '大石', '鎌田', '成田', '宮田', '小田', '石橋', '篠原', '須藤', '河野', '大沢', '小西', '南', '高山',
			'栗原', '伊東', '松原', '三宅', '福井', '大森', '奥村', '岡', '内山', '片岡'
		);
		$namaeAry = array('大輔', '誠', '直樹', '亮', '剛', '大介', '学', '健一', '健', '哲也', '聡', '健太郎', '洋平', '淳', '竜也', '崇',
			'翔太', '拓也', '健太', '翔', '達也', '雄太', '翔平', '大樹', '大輔', '和也', '達也', '翔太', '徹', '哲也', '秀樹', '英樹',
			'浩二', '健一', '博', '博之', '修', '大輝', '拓海', '海斗', '大輔', '大樹', '翔太', '大輝', '翼', '拓海', '直人', '康平',
			'達也', '駿', '雄大', '亮太', '拓也', '大貴', '亮太', '拓哉', '雄大', '誠', '隆', '茂', '豊', '明', '浩', '進', '勝',
			'洋子', '恵子', '京子', '幸子', '和子', '久美子', '由美子', '裕子', '美智子', '悦子', '智子', '久美子', '陽子', '理恵', '真由美',
			'香織', '恵', '愛', '優子', '智子', '裕美', '真由美', 'めぐみ', '美穂', '純子', '美紀', '彩', '美穂', '成美', '沙織', '麻衣',
			'舞', '愛美', '瞳', '彩香', '麻美', '沙織', '麻衣', '由佳', 'あゆみ', '友美', '麻美', '裕子', '美香', '恵美', '直美', '由美',
			'陽子', '直子', '未来', '萌', '美咲', '亜美', '里奈', '菜々子', '彩花', '遥', '美咲', '明日香', '真由', '楓', '奈々', '彩花',
			'優花', '桃子', '美咲', '佳奈', '葵', '菜摘', '桃子', '茜', '明美', '京子', '恵子', '洋子', '順子', '典子'
		);
		$key_myouji = array_rand($myoujiAry);
		$key_namae = array_rand($namaeAry);
		$myouji = $myoujiAry[$key_myouji];
		$namae = $namaeAry[$key_namae];
		return $myouji." ".$namae;
	}

	public static function make_html_course_ckbox($target){
		$target_CourceArray_array=InitConsts::CourceArray();
		$htm_course_ckbox='';
		foreach($target_CourceArray_array as $cource){
			$cked='';
			if(mb_strstr( $target,$cource)!== false){$cked='checked="checked"';}
			$htm_course_ckbox.='<label class="block font-medium text-sm text-gray-700"><input class="form-check-input" type="checkbox" name="course[]" value="'.$cource.'" '.$cked.'>&nbsp;'.$cource.'<label>';
		}
		return $htm_course_ckbox;
	}

	public static function make_html_gender_ckbox($target){
		$htm_gender_ckbox='';$gender_array=array();
		$gender_array[0]='男';$gender_array[1]='女';
		$i=0;
		foreach($gender_array as $gender){
			$cked='';
			if($target==$gender){$cked='checked="checked"';}
			$htm_gender_ckbox.='<label class="block font-medium text-sm text-gray-700"><input class="form-check-inputm" type="checkbox" name="gender[]" id=gender['.$i.'] value="'.$gender.'" '.$cked.' onchange="gender_manage(this);">&nbsp;'.$gender.'<label>';
			$i++;
		}
		return $htm_gender_ckbox;
	}

	public static function set_access_history($REFERER){
		//print isset($_SESSION['access_history']);
		if(isset($_SESSION['access_history'])){
			if(is_array($_SESSION['access_history'])){
				array_unshift($_SESSION['access_history'],$REFERER);
			}else{
				$_SESSION['access_history']=array();
				$_SESSION['access_history'][]=$REFERER;
			}
		}else{
			$_SESSION['access_history']=array();
			$_SESSION['access_history'][]=$REFERER;
		}
	}

	public static function get_teacher_new_serial(){
		$max_serial=User::max('serial_user');
		$new_serial=$max_serial++;
		return $new_serial;
	}

	public static function get_student_new_serial(){
		$max_serial=Student::max('serial_student');
		$new_serial=$max_serial++;
		return $new_serial;
	}

	public static function make_html_grade_slct($targetgrade){
		//print "targetgrade=".$targetgrade;
		$target_grade_array=InitConsts::GradeArray();
		$htm_grade_slct='<select id="grade" name="grade" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>';
		$htm_grade_slct.='<option value="" disabled selected style="display:none;"></option>';
		foreach($target_grade_array as $grade){
			$slctd='';
			//print "grade=".$grade."<br>";
			if($targetgrade==$grade){$slctd='Selected="selected"';}
			$htm_grade_slct.='<option value="'.$grade.'" '.$slctd.' >'.$grade.'</option>';
		}
        $htm_grade_slct.='</select>';
		return $htm_grade_slct;
	}
}