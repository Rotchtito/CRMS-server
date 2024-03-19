<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->foreignId('complainant_id')->constrained('complainants');
            $table->foreignId('suspect_id')->constrained('suspects');
            $table->string('status')->default('pending');
            $table->foreignId('police_in_charge_id')->nullable()->constrained('users');
            $table->json('evidence')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}

