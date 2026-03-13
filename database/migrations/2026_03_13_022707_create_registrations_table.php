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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            // Room Information
            // Kolom dibuat sebagai unsignedBigInteger dulu (nullable),
            // lalu foreign key ditambahkan eksplisit — ini menghindari errno:150 di MySQL.
            $table->unsignedBigInteger('room_id_1')->nullable();
            $table->unsignedBigInteger('room_id_2')->nullable();
            $table->foreign('room_id_1')->references('id')->on('rooms')->nullOnDelete();
            $table->foreign('room_id_2')->references('id')->on('rooms')->nullOnDelete();

            $table->integer('number_of_persons')->nullable();
            $table->integer('number_of_rooms')->nullable();
            $table->string('room_type')->nullable();
            $table->string('receptionist')->nullable();

            // Guest Information
            $table->string('name');
            $table->string('profession')->nullable();
            $table->string('company')->nullable();
            $table->string('nationality')->nullable();
            $table->string('id_passport_number')->nullable()->comment('No. KTP / Passport No.');
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('member_number')->nullable();

            // Stay Information
            $table->dateTime('arrival_time')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();

            // Safety Deposit Box
            $table->string('safety_deposit_box_number')->nullable();
            $table->string('issued_by')->nullable();
            $table->date('issued_date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign(['room_id_1']);
            $table->dropForeign(['room_id_2']);
        });
        Schema::dropIfExists('registrations');
    }
};
