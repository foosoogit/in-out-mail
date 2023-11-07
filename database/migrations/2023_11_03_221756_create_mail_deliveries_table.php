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
        Schema::create('mail_deliveries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->text('student_serial')->comment('送り先生徒番号');
            $table->string('date_delivered',30)->comment('日付');
            $table->text('student_name',50)->comment('配信者');
            $table->text('to_mail_address')->comment('送り先メールアドレス');
            $table->string('from_mail_address',50)->comment('送り元メールアドレス');
            $table->text('subject')->comment('件名');
            $table->text('body')->comment('本文');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_deliveries');
    }
};
