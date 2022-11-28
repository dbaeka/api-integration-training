<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('internal_reference');
            $table->string('type', 40);
            $table->string('status_code', '3')->default(411);
            $table->string('buyer_name')->nullable();
            $table->string('buyer_msisdn');
            $table->string('country', 2);
            $table->string('currency', 3);
            $table->string('amount');
            $table->string('third_party_reference');
            $table->string('description', 300)->nullable();
            $table->string('callback_url')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
