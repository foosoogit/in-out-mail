<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InitConsts;
use App\Models\Student;
use App\Http\Controllers\TeachersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('show_standby_display', function(){
    session(['student_serial' => ""]);
    return view('admin.StandbyDisplayJQ');
})->name('teachers.show_standby_display');

Route::get('/show_rireki_for_protector', function () {
    //session(['serchKey' =>$request->studserial]);
    return view('protector.RirekiForProtector');
})->name('show_rireki_for_protector');
Route::post('/show_rireki_for_protector', function () {
    //session(['serchKey' =>$request->studserial]);
    return view('protector.RirekiForProtector');
})->name('show_rireki_for_protector');

Route::get('/login_protector', function () {
    return view('protector.LoginProtector');
})->name('protector.login');
/*
Route::get('/', function () {
    $user = User::first();
    Mail::send(new ContactMail($user));
    return view('welcome');
});
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/menu', function () {
    //return view('dashboard');
    $MAIL_FROM_NAME=env('MAIL_FROM_NAME');
    return view('admin.menu',compact('MAIL_FROM_NAME'));
})->middleware(['auth', 'verified'])->name('menu');
Route::view('barcode', 'barcode');
//Route::get('students/create', 'create')->name('student.create');
//Route::middleware('auth')->group(function () {
Route::group(['middleware' => ['auth']], function(){
    Route::controller(TeachersController::class)->name('teachers.')->group(function() {
        Route::post('/teachers/ajax_get_mail_sending_to', [TeachersController::class,'ajax_get_mail_sending_to'])->name("ajax_get_mail_sending_to");
        Route::post('/teachers/update_MailAccount','update_MailAccount')->name('email_account.update');
        Route::get('/show_email_account_setup','show_email_account_setup')->name('show_email_account_setup');
        Route::get('/','show_setting')->name('show_setting');
        Route::post('teachers/execute_mail_delivery', 'execute_mail_delivery')->name('execute_mail_delivery');
        Route::get('teachers/show_delivery_email', 'show_delivery_email')->name('show_delivery_email.get');
        Route::post('teachers/show_delivery_email', 'show_delivery_email')->name('show_delivery_email.post');

        Route::get('livewire/message/mail-delivery', 'stud_list_maildelivery');

        Route::get('teachers/show_delivery_email_list_students', function () {
            return view('admin.MailDelivery');
        })->name('show_delivery_email_list_students');

        Route::post('teachers/show_delivery_email_list_students', function () {
            return view('admin.MailDelivery');
        })->name('show_delivery_email_list_students.post');

        Route::get('teachers/show_delivery_email_history_list', function () {
            return view('admin.HistoryMailDelivery');
        })->name('show_delivery_email_history_list');

        Route::post('teachers/show_delivery_email_history_list', function () {
            return view('admin.HistoryMailDelivery');
        })->name('show_delivery_email_history_list.post');

        Route::get('teachers/show_create_email', function () {
            return view('admin.CreateMail');
        })->name('show_create_email');

        Route::get('teachers/send_test_mail/{type}', [\App\Http\Controllers\StudentController::class,'ShowStudentModifyList'])->name('Students.list_ck_modify');
        Route::post('teachers/setting_update', 'update_setting')->name('setting.update');
        Route::get('teachers', 'index')->name('index');
        Route::get('teachers/create', 'create')->name('create');
        Route::post('teachers', 'store')->name('store');
        Route::get('teachers/{teacher}', 'show')->name('show');
        //Route::get('teachers/{teacher}/edit', 'edit')->name('edit');
        Route::post('teachers/edit', 'edit')->name('edit');
        Route::put('teachers/{teacher}', 'update')->name('update');
        Route::delete('teachers/{teacher}', 'destroy')->name('destroy');
        Route::get('teachers/{id}/show_change_password', 'show_change_password')->name('show_change_password');
        Route::post('teachers/store_password', 'store_password')->name('store_password');

        //Route::post('teachers/send_mail', 'send_mail')->name('send_mail');
        Route::post('send_mail_in_out', [\App\Http\Controllers\TeachersController::class,'send_mail_in_out'])->name("send_mail_in_out");
        Route::post('in_out_manage', [\App\Http\Controllers\TeachersController::class,'in_out_manage'])->name("in_out_manage");

        /*
        Route::get('show_standby_display', function () {
            session(['student_serial' => ""]);
            return view('admin.StandbyDisplay');
        })->name('show_standby_display');
        */
       
        /*
        Route::post('show_standby_display', function () {
            return view('admin.StandbyDisplay');
        })->name('show_standby_display');
        */
        //view('admin.StandbyDisplay')
        //Route::get('show_standby_display','show_standby_display')->name('show_standby_display');
        //Route::post('teachers','send_mail')->name('send_mail');
    });

    //Route::get('students/ShowRireki', [\App\Http\Controllers\StudentController::class,'ShowRireki'])->name('showRireki');

    Route::get('ShowRireki', function () {
        //session(['serchKey' =>$request->studserial]);
        session(['serchKey' =>'']);
        session(['sort_key' =>"time_in"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListRireki');
    })->name('admin.showRireki');

    Route::post('ShowRireki', function (Request $request) {
        Log::alert('studserial-1='.$request->studserial);
        session(['serchKey' =>$request->studserial]);
        session(['sort_key' =>"time_in"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListRireki');
    })->name('admin.showRireki');

    //Route::post('students/ShowRireki', [\App\Http\Controllers\StudentController::class,'ShowRireki'])->name('showRireki');
    //Route::get('students/ShowRireki/{studserial}', [\App\Http\Controllers\StudentController::class,'ShowRireki'])->name('showRireki');
    Route::delete('students/delete/{StudentID}', [\App\Http\Controllers\StudentController::class,'destroy'])->name('student.delete');
    Route::put('students/{Student}', [\App\Http\Controllers\StudentController::class,'update'])->name('student.update');
    Route::post('students/update_JQ', [\App\Http\Controllers\StudentController::class,'update_JQ'])->name('student.update_JQ');

    /*
    Route::get('students/list', function () {
        return view('admin.ListStudents');
    });
    */
    
    //Route::get('students/list', [ListStudents::class,'render'])->name('Students.List.get');
    //Route::get('students/list', ListStudents::class)->name('Students.List.get');

    
    /*
    Route::get('students/list', function () {
        //session(['serchKey' =>""]);
        return view('admin.ListStudents');
    })->name('Students.List.get');

    //Route::get('/students/list',ListStudents::class)->name('Students.List.get');
    Route::post('students/list', [ListStudents::class,function(Request $request){}])->name('Students.List.post');
   */


    /*
    Route::post('students/list', function () {
        //session(['serchKey' =>""]);
        return view('admin.ListStudents');
    })->name('Students.List.post');
    */
    Route::get('students/list_ner_num', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"email"]);
        session(['sort_key2' =>"id"]);
        session(['asc_desc' =>'ASC']);
        session(['asc_desc2' =>'ASC']);
        return view('admin.ListStudents');
    })->name('Students.NewNumList');

    Route::get('students/list_ck_store', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"serial_student"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListStudents');
    })->name('Students.list_ck_store');
    Route::get('students/list_ck_modify/{stud_seraial}', [\App\Http\Controllers\StudentController::class,'ShowStudentModifyList'])->name('Students.list_ck_modify');
    Route::post('students/list_ck_store', function () {
        session(['serchKey' =>""]);
        session(['sort_key' =>"serial_student"]);
        session(['asc_desc' =>'desc']);
        return view('admin.ListStudents');
    })->name('Students.list_ck_store');
    
    Route::get('students/store', function () {
        return view('admin.CreateStudent');
    })->name('students.store');

    Route::post('students/ShowInputStudent', [\App\Http\Controllers\StudentController::class,'ShowInputStudent'])->name('ShowInputStudent.Modify');
    Route::get('students/ShowInputStudent', [\App\Http\Controllers\StudentController::class,'ShowInputStudent'])->name('ShowInputStudent.Modify');
    
    Route::get('students/create', [\App\Http\Controllers\StudentController::class,'ShowInputNewStudent'])->name('Students.Create');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::post('students', [\App\Http\Controllers\StudentController::class,'store'])->name('student');
    Route::post('students/store', [\App\Http\Controllers\StudentController::class,'store'])->name('student.store');

    Route::get('students/list', [TeachersController::class, 'show_students_list'])->name('Students.List.get');
    Route::get('livewire/message/list-students', [TeachersController::class, 'show_students_list']);

    Route::get('livewire/update', [TeachersController::class, 'show_students_list']);

    

    //Route::post('students/list', [TeachersController::class, 'test'])->name('Students.List.post');

   //Route::get('/logout', 'Auth\LoginController@logout');
});
require __DIR__.'/auth.php';