<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CreateDzAssetLocksTable
 * @package Drivezy\LaravelAssetManager\Migrations
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class CreateDzAssetLocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_asset_locks', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->bigIncrements('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('asset_detail_id');

            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->dateTime('expiry_time');

            $table->bigInteger('start_timestamp')->nullable();
            $table->bigInteger('end_timestamp')->nullable();
            $table->bigInteger('expiry_timestamp')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('user_id')->references('id')->on($userTable);
            $table->foreign('asset_detail_id')->references('id')->on('dz_asset_details');

            $table->foreign('created_by')->references('id')->on($userTable);
            $table->foreign('updated_by')->references('id')->on($userTable);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('dz_asset_locks');
    }
}
