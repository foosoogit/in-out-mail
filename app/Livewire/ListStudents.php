<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use App\Http\Controllers\InitConsts;
use App\Http\Controllers\OtherFunc;
use Illuminate\Support\Collection;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;

//QRコードライブラリに必要な読み込み
/*
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Lavel\Alignment\LavelAlignmentCenter;
use Endroid\QrCode\Lavel\Font\NotoSans;
*/

class ListStudents extends Component
{
    use WithPagination;
    public $sort_key_p = '',$asc_desc_p="",$serch_key_p="",$targetPage=null;
	public $kensakukey="";
    public static $key="";
    public $Unregistered_flg=false;
    public $Retiree_flg=false;
    public $orderColumn = "serial_student";
    public $sortOrder = "asc";
    public $StudentQuery="";

    public function csv_download(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("在籍生徒一覧");
        $sheet->setCellValue('A1', '生徒番号');
        $sheet->getStyle( 'A1' )->getAlignment()->setHorizontal('center');  // 中央寄せ
        $sheet->setCellValue('B1', '氏名');
        $sheet->setCellValue('C1', 'QRコード');
        $students_array=Student::where("status", "在籍")->get();
        $cnt=2;
        foreach($students_array as $student_inf){
            $sheet->setCellValue('A'.$cnt, $student_inf->serial_student);
            $sheet->getStyle( 'A'.$cnt )->getAlignment()->setHorizontal('center');  // 中央寄せ
            $sheet->setCellValue('B'.$cnt, $student_inf->name_sei.' '.$student_inf->name_mei);
            $sheet->setCellValue('c'.$cnt,'');
           //if($cnt==2){
                /*
                $writer = new PngWriter();
		        //Create QR code
		        $qrCode = new QrCode(
                    data: $target_sentence,
                    encoding: new Encoding('UTF-8'),
                    errorCorrectionLevel: ErrorCorrectionLevel::Low,
                    size: 300,
                    margin: 10,
                    roundBlockSizeMode: RoundBlockSizeMode::Margin,
                    foregroundColor: new Color(0, 0, 0),
                    backgroundColor: new Color(255, 255, 255)
                );
                */
		        //Create generic logo
                /*
                $logo = new Logo(
                    path: storage_path('images/Luxer_image.png'),
                    resizeToWidth: 50,
                    punchoutBackground: true
                );
                */
                // Create generic label
                /*
                $label = new Label(
                    text: $student_inf->serial_student,
                    textColor: new Color(255, 0, 0)
                );
                //$result = $writer->write($qrCode, $logo, $label);
                $result = $writer->write($qrCode, $label);
                
                // Validate the result
                $writer->validateResult($result, $target_sentence);
                */
                //header('Content-Type: '.$result->getMimeType());
                //echo $result->getString();
                // Save it to a file
                
                //$result->saveToFile(storage_path('images/'.$TargetStaffSerial.'.png'));
                //$result->saveToFile($save_path);
                /*
                $qrCode = Builder::create()
                ->writer(new PngWriter)
                ->writerOptions([])
                ->data($student_inf->serial_student)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorectionLevel(new ErrorCorrectionLevelHigh())
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(new RoundBlockSizeMode())
                ->lavelText($student_inf->serial_student)
                ->lavelFont(new NotoSans())
                ->lavelAlignment(new LavelAlignmentCenter)
                ->validateResult(False);
                $res=$qrCode;
                file_put_contents(uniqid().'.png',$res->getstring());
            
            */
            //}
            /*
            $qrCode = QrCode::create($student_inf->serial_student)
                // 文字エンコーディングの設定（UTF-8にすることで日本語などの特殊文字も対応可能）
                ->setEncoding(new Encoding('UTF-8'))

                // 誤り訂正レベル（QRコードの一部が欠けても復元できる強度）
                // High（30% まで復元可能）を設定
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::High)

                // QRコードのサイズ（200px 四方に設定）
                ->setSize(200)

                // QRコードの余白（10px に設定）
                // 余白がないと一部のリーダーで読み取れない可能性がある
                ->setMargin(10)

                // QRコードの四角形のサイズを調整（ブロックサイズを余白基準に設定）
                ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)

                // QRコードの前景色（黒に設定）
                ->setForegroundColor(new Color(0, 0, 0))

                // QRコードの背景色（白に設定）
                ->setBackgroundColor(new Color(255, 255, 255));

            // QRコードをPNGで出力
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            */
            /*
            $sheet->getStyle( 'B1' )->getAlignment()->setHorizontal('center');  // 中央寄せ
            $sheet->getStyle( 'C1' )->getAlignment()->setHorizontal('center');  // 中央寄せ
            $sheet->getStyle( 'D1' )->getAlignment()->setHorizontal('center');  // 中央寄せ
            $sheet->getColumnDimension( 'A' )->setWidth( 13 );
            $sheet->getColumnDimension( 'B' )->setWidth( 20 );
            $sheet->getColumnDimension( 'C' )->setWidth( 20 );
            $sheet->getColumnDimension( 'D' )->setWidth( 10 );
            */
            $cnt++;
        }
        $writer = new Xlsx($spreadsheet);
        $fileName='Students_list_'.date("Y_m_d").'.xlsx';
        $writer->save($fileName);
        $filePath = $fileName;
        $mimeType = File::mimeType($filePath);
            $headers = [['Content-Type' => $mimeType,
                  'Content-Disposition' => 'attachment; filename*=UTF-8\'\''.rawurlencode($fileName)
            ]];
        return response()->download($fileName);
        $this->skipRender();
     }

    public function registered(){
        if(session('registered_flg')=="checked"){
            session(['registered_flg' => ""]);
        }else{
            session(['registered_flg' => "checked"]);
        }
    }
    
    public function unregistered(){
        if(session('unregistered_flg')=="checked"){
            session(['unregistered_flg' => ""]);
        }else{
            session(['unregistered_flg' => "checked"]);
        }
    }

    public function withdrawn(){
        if(session('withdrawn_flg')=="checked"){
            session(['withdrawn_flg' => ""]);
        }else{
            session(['withdrawn_flg' => "checked"]);
        }
    }

    public function graduation(){
        if(session('graduation_flg')=="checked"){
            session(['graduation_flg' => ""]);
        }else{
            session(['graduation_flg' => "checked"]);
        }
    }

    public function searchClear(){
		$this->serch_key_p="";
		$this->kensakukey="";
        $this->orderColumn = "serial_student";
        $this->sortOrder = "asc";
        $this->targetPage=null;
        $this->Unregistered_flg=false;
        $this->Retiree_flg=false;
        $this->serch_key_p="";
		$this->kensakukey="";
		session(['serchKey' => '']);
    }

    public function search_from_top_menu(Request $request){
		$this->serch_key_p=$request->input('user_serial');
        session(['serchKey_stud' => $request->input('user_serial')]);
        $_SESSION['serchKey_stud']=$request->input('user_serial');
	}

    public function search(){
        $this->targetPage=1;
        $this->serch_key_p=$this->kensakukey;
		session(['serchKey' => $this->kensakukey]);
	}

    public function sort($sort_key){
        $sort_key_array=array();
		$sort_key_array=explode("-", $sort_key);
		session(['sort_key' =>$sort_key_array[0]]);
		session(['asc_desc' =>$sort_key_array[1]]);
	}

    public function render(){
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }

        if(!isset($sort_key_p) and session('sort_key')==null){
            session(['sort_key' =>'']);
        }
        $this->sort_key_p=session('sort_key');
    
        if(!isset($asc_desc_p) and session('asc_desc')==null){
            session(['asc_desc' =>'ASC']);
        }
        $this->asc_desc_p=session('asc_desc');
        $StudentQuery = Student::query();
        $status_array=array();
        
        if(session('registered_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','在籍');
        }
        if(session('withdrawn_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','退会');
        }
        if(session('graduation_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','卒業');
        }
        if(session('unregistered_flg')<>"checked"){
            $StudentQuery=$StudentQuery->where('status','<>','');
        }
        
        if($this->kensakukey<>""){
            self::$key="%".$this->kensakukey."%";
            $StudentQuery =$StudentQuery->where(function($query) {
            $query->where('serial_student','like',self::$key)
                ->orwhere('name_sei','like',self::$key)
                ->orwhere('name_mei','like',self::$key)
                ->orwhere('name_sei_kana','like',self::$key)
                ->orwhere('name_mei_kana','like',self::$key)
                ->orwhere('grade','like',self::$key)
                ->orwhere('phone','like',self::$key)
                ->orwhere('course','like',self::$key)
                ->orwhere('email','like',self::$key);
            });
        }

        $targetSortKey="";
        if(session('sort_key')<>""){
            $targetSortKey=session('sort_key');
        }else{
            $targetSortKey=$this->sort_key_p;
        }

        if($this->sort_key_p=='time_in' | $this->sort_key_p=='time_out'){
            $this->sort_key_p='serial_student';
        }
        if($this->sort_key_p<>''){
            if($this->sort_key_p=="name_sei"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei', 'desc');
                }
            }else if($this->sort_key_p=="name_sei_kana"){
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'asc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy('name_sei_kana', 'desc');
                    $StudentQuery =$StudentQuery->orderBy('name_mei_kana', 'desc');
                }
            }else{
                if($this->asc_desc_p=="ASC"){
                    $StudentQuery =$StudentQuery->orderBy($this->sort_key_p, 'asc');
                }else{
                    $StudentQuery =$StudentQuery->orderBy($this->sort_key_p, 'desc');
                }
            }
        }
        $REQUEST_array=explode("page=", $_SERVER['REQUEST_URI']);
        if(isset($REQUEST_array[1])){
            session(['page_history' => $REQUEST_array[1]]);
        }
        if(!str_contains($_SERVER['HTTP_REFERER'], "students/list")){
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',session('page_history'));
        }else{
            $students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*']);
        }

        //session(['HTTP_REFERER' => $_SERVER['HTTP_REFERER']]);
        //$page_history=$REQUEST_array[1];
        return view('livewire.list-students',['students'=>$students,]);
    }

    public function search_stud(){
        if(isset($_SERVER['HTTP_REFERER'])){
            OtherFunc::set_access_history($_SERVER['HTTP_REFERER']);
        }
        $StudentQuery = Student::query();
        if(isset($_POST['btn_serial'])){
            $_SESSION['serchKey_stud']=$_POST['btn_serial'];
        }else if(!isset($_SESSION['serchKey_stud'])){
            $_SESSION['serchKey_stud']=$this->serch_key_p;
        }
        $targetSortKey="";
        if(isset($_SESSION['sortKey_stud'])){
            $StudentQuery =$StudentQuery->orderBy($_SESSION['sortKey_stud'], $_SESSION['asc_desc_stud']);
        }
        $this->students=$StudentQuery->paginate($perPage = initConsts::DdisplayLineNumStudentsList(),['*'], 'page',$this->targetPage);
        $this->targetPage=null;
    }
}