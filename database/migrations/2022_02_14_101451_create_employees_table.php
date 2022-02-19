<?php

use App\Models\Address;
use App\Models\Job;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('');
            $table->foreignIdFor(Job::class)->constrained()->cascadeOnDelete();
            $table->string('employee_id');
            $table->string('name');
            $table->date('date_joined');
            $table->tinyText('qualification');
            $table->string('work_type')->default('Full-Time');
            $table->double('basic_salary');
            $table->string('contact_number');
            $table->string('email');
            $table->date('birth_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
