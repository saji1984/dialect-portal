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
        Schema::create('enquiry_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enquiry_id');
            $table->unsignedBigInteger('enquiry_relation_id');
            $table->unsignedBigInteger('from_id');
            $table->text('body')->nullable();
            $table->integer('type')->default(2); /* 1 => interest 2 => reply */
            $table->integer('status')->default(0); /* 0 => Pending Review, 1 => Shortlisted, 2 => On Hold */ 
            $table->string('hold_reason')->nullable();
            $table->integer('is_recommanded')->default(0);
            $table->string('suggested_remarks')->nullable();
            $table->integer('is_read')->default(0);
            $table->integer('is_selected')->default(0);
            $table->integer('is_ignored')->default(0);
            $table->integer('is_interested')->default(0);
            $table->dateTime('participation_approved')->nullable(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_replies');
    }
};
