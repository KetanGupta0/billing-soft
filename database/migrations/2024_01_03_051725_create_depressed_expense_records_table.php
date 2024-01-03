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
        Schema::create('depressed_expense_records', function (Blueprint $table) {
            $table->id();
            $table->date('d_e_r_date');
            $table->bigInteger('d_e_r_remark');
            $table->bigInteger('d_e_r_amount');
            $table->bigInteger('d_e_r_ac_from');
            $table->bigInteger('d_e_r_for');
            $table->bigInteger('d_e_r_status');
            $table->bigInteger('d_e_r_tnx_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depressed_expense_records');
    }
};
