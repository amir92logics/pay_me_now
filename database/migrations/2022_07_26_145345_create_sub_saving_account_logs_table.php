<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSavingAccountLogsTable extends Migration
{
    /**
     * Run the migrations.
     * trx_type 0 means debit
     * trx_type 1 means credit
     * @return void
     */
    public function up()
    {
        Schema::create('sub_saving_account_logs', function (Blueprint $table) {
            $table->id();
            $table->string('trx')->nullable();
            $table->boolean('trx_type')->default(1);
            $table->string('details')->nullable();
            $table->unsignedBigInteger('amount')->nullable();
            $table->unsignedBigInteger('charge')->nullable();
            $table->unsignedBigInteger('initial_balance')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_saving_account_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('sub_saving_account_logs');
    }
}
