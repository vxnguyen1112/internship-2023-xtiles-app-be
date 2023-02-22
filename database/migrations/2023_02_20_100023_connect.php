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
        Schema::table('contents', function (Blueprint $table) {
            $table->foreignUuid('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });
        Schema::table('blocks', function (Blueprint $table) {
            $table->foreignUuid('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignUuid('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreignUuid('account_id')->references('id')->on('accounts');
            $table->foreignUuid('document_id')->references('id')->on('documents');
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignUuid('account_id')->references('id')->on('accounts');
            $table->foreignUuid('workspace_id')->references('id')->on('workspaces');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignUuid('document_id')->references('id')->on('documents');
        });
        Schema::table('workspaces', function (Blueprint $table) {
            $table->foreignUuid('account_id')->references('id')->on('accounts');
        });
        Schema::table('trackers', function (Blueprint $table) {
            $table->foreignUuid('document_id')->references('id')->on('documents');
            $table->foreignUuid('account_id')->references('id')->on('accounts');
        });
        Schema::table('document_accounts', function (Blueprint $table) {
            $table->foreignUuid('account_id')->references('id')->on('accounts');
            $table->foreignUuid('document_id')->references('id')->on('documents');
        });
        Schema::table('favourite_documents', function (Blueprint $table) {
            $table->foreignUuid('document_id')->references('id')->on('documents');
            $table->foreignUuid('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
