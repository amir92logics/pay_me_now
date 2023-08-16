<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('trx')->nullable();
            $table->double('amount')->nullable();
            $table->integer('status')->default(2); // 1 = Completed, 2 = Pending, 0 = Rejected
            $table->double('charge')->nullable();
            $table->double('rate')->nullable();
            $table->string('type'); // cheque, bank_transfer, autometic, cash
            $table->text('meta')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
