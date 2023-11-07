<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configration;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $configrations = [
			[
				'subject'=> "JyukuName",
				'value1' => "教進セミナー",
				'setumei' => "塾名",
            ],
			[
				'subject'=> "DdisplayLineNumStudentsList",
				'value1' => "15",
				'setumei' => "生徒リストの表示行数",
            ],
			[
				'subject'=> "DdisplayLineNumDeliveryStudentsList",
				'value1' => "20",
				'setumei' => "メール配信用生徒リストの表示行数",
            ],
			[
				'subject'=> "Grade",
				'value1' => "小1,小2,小3,小4,小5,小6,中1,中2,中3,高1,高2,高3",
				'setumei' => "学年",
			],
			[
				'subject'=> "Course",
				'value1' => "学習塾,英会話",
				'setumei' => "コース",
			],
			[
				'subject'=> "Interval",
				'value1' => "5",
				'setumei' => "退出時間までの最短時間（分、以上）",
			],
			[
				'subject'=> "sbjIn",
				'value1' => "[name-student]様が入室されました。---[name-jyuku]---",
				'setumei' => "入出メッセージの件名",
			],
			[
				'subject'=> "MsgIn",
				'value1' => "[name-protector]様
				[name-student]さんが入室されました。
				入出時間：[time]",
				'setumei' => "入室時メッセージ",
			],
			[
				'subject'=> "sbjOut",
				'value1' => "[name-student]様が退出されました。---[name-jyuku]---",
				'setumei' => "退出メッセージの件名",
			],
			[
				'subject'=> "MsgOut",
				'value1' => "[name-protector]様
				[name-student]さんが退出されました。
				退室時間：[time]",
				'setumei' => "入室時メッセージ",
			],
			[
				'subject'=> "MsgTest",
				'value1' => "[name-protector]様
				このメールは送信テストです。受け取られましたら、そのまま返信ください。
				生徒お名前：[name-student]様
				受け取られる方のお名前：[name-protector]様
				送信時間：[time]",
				'setumei' => "送信テストメッセージ",
			],
			[
				'subject'=> "MsgFooter",
				'value1' => "教進セミナー",
				'setumei' => "送信メールフッター",
			],
			[
				'subject'=> "sbjTest",
				'value1' => "テストメール --[name-jyuku]--",
				'setumei' => "テストメールの件名",
			],
            [
				'subject'=> "CourseSubjects",
				'value1' => "英語,数学,理科,社会,国語",
				'setumei' => "受講教科",
			],
            [
				'subject'=> "Instructor",
				'value1' => "鈴木,平山,福原",
				'setumei' => "担当講師",
			],
        ];
		foreach($configrations as $configration) {
			$conf = new Configration();
			$conf->subject=$configration['subject'];
            $conf->value1 = $configration['value1'];
			$conf->setumei = $configration['setumei'];
			$conf->save();
		}

        $init_students = [
            [
				'serial_student' => '200000000000',
                'email' => 'awa@szemi-gp.com',
                'name_sei' => '鈴木',
                'name_mei'=> '文彦',
                'name_sei_kana'=> 'すずき',
                'name_mei_kana'=> 'ふみひこ',
                'gender'=> '男',
                'protector'=> '鈴木清',
                'pass_for_protector'=>'1234',
                'postal'=> '299-2715',
                'address_region'=> '千葉県',
                'address_locality'=> '南房総市',
                'address_banti'=> '和田町下三原390-1',
                'phone'=> '090-4224-2778',
                'grade'=> '高1',
                'course'=> '学習塾',
                'subjects'=> '英語',
                'instructor'=> '平山',
            ],
			[
				'serial_student' => '200000000001',
                'email' => 'awa@szemi-gp.com',
                'name_sei' => '飯沼',
                'name_mei'=> '紗矢',
                'name_sei_kana'=> 'いいぬま',
                'name_mei_kana'=> 'さや',
                'gender'=> '女',
                'protector'=> '飯沼みどり',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '高1',
                'course'=> '学習塾',
                'subjects'=> '英語',
                'instructor'=> '平山',
            ],
			[
				'serial_student' => '200000000002',
                'email' => 'prime@szemi-gp.com',
                'name_sei' => '高松',
                'name_mei'=> 'りほな',
                'name_sei_kana'=> 'たかまつ',
                'name_mei_kana'=> 'りほな',
                'gender'=> '女',
                'protector'=> '高松弘',
                'pass_for_protector'=>'',
                'postal'=> '',
                'address_region'=> '',
                'address_locality'=> '',
                'address_banti'=> '',
                'phone'=> '',
                'grade'=> '高1',
                'course'=> '学習塾',
                'subjects'=> '英語,数学',
                'instructor'=> '平山,鈴木',
            ],
        ];
        foreach($init_students as $init_student) {
			$student = new Student();
			$student->serial_student=$init_student['serial_student'];
            $student->email = $init_student['email'];
			$student->name_sei = $init_student['name_sei'];
			$student->name_mei = $init_student['name_mei'];
			$student->name_sei_kana = $init_student['name_sei_kana'];
			$student->name_mei_kana = $init_student['name_mei_kana'];
			$student->gender = $init_student['gender'];
			$student->protector = $init_student['protector'];
			$student->pass_for_protector = $init_student['pass_for_protector'];
			$student->postal = $init_student['postal'];
			$student->address_region = $init_student['address_region'];
			$student->address_locality = $init_student['address_locality'];
			$student->address_banti = $init_student['address_banti'];
			$student->phone = $init_student['phone'];
			$student->grade = $init_student['grade'];
			$student->course = $init_student['course'];
			$student->save();
		}

        $init_users = [
			[
			'serial_user'=> "T_0001",
			'email' => "awa@szemi-gp.com",
			'password' => "0000",
			'last_name_kanji' => "鈴木",
			'first_name_kanji' => "文彦",
			'last_name_jp_kana' => "すずき",
			'first_name_jp_kana' => "ふみひこ",
			'rank' => "admin",
			'phone'=> "123-4567-8901",
			'gender' => "男",
            ],
        ];
        foreach($init_users as $init_user) {
			$user = new User();
			$user->serial_user=$init_user['serial_user'];
            $user->email = $init_user['email'];
            $user->password = Hash::make($init_user['password']);
			$user->name_sei = $init_user['last_name_kanji'];
			$user->name_mei = $init_user['first_name_kanji'];
			$user->name_sei_kana = $init_user['last_name_jp_kana'];
			$user->name_mei_kana = $init_user['first_name_jp_kana'];
			$user->rank = $init_user['rank'];
			$user->phone = $init_user['phone'];
			$user->save();
		}

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
