<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('serial_student',20)->unique()->comment('生徒番号');
            $table->string('email')->nullable()->comment('メールアドレス（複数の場合はカンマでつなげる）');
            $table->string('name_sei',100)->nullable()->comment('姓');
			$table->string('name_mei',100)->nullable()->comment('名');
			$table->string('name_sei_kana',100)->nullable()->comment('セイ');
			$table->string('name_mei_kana',100)->nullable()->comment('メイ');
            $table->string('protector',100)->nullable()->comment('保護者');
            $table->string('pass_for_protector',10)->nullable()->comment('保護者閲覧用パスワード');
			$table->string('gender',10)->nullable();
			$table->string('birth_year',10)->nullable();
			$table->string('birth_month',10)->nullable();
			$table->string('birth_day',10)->nullable();
			$table->string('postal',15)->nullable();
			$table->string('address_region')->nullable();
			$table->string('address_locality')->nullable();
			$table->string('address_banti')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('grade',10)->nullable()->comment('学年');
            $table->string('elementary',10)->nullable()->comment('学校名');
            $table->string('junior_high',10)->nullable()->comment('中学校');
            $table->string('high_school',10)->nullable()->comment('高校');
            $table->string('course',50)->nullable()->comment('受講コース');
            $table->string('subjects',50)->nullable()->comment('受講教科'); 
            $table->string('instructor',50)->nullable()->comment('担当講師');
            $table->string('status',20)->default('')->comment('在籍状態 defaultは空文字');
            $table->text('note')->nullable()->comment('備考');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};