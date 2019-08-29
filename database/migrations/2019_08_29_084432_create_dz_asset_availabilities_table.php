<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CreateDzAssetAvailabilitiesTable
 * @package Drivezy\LaravelAssetManager\Migrations
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class CreateDzAssetAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_asset_availabilities', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->bigIncrements('id');

            $table->unsignedBigInteger('start_timestamp')->nullable();
            $table->unsignedBigInteger('end_timestamp')->nullable();

            $table->unsignedInteger('asset_category_id')->nullable();
            $table->unsignedInteger('asset_detail_id')->nullable();

            $table->unsignedInteger('venue_id')->nullable();

            $table->unsignedInteger('duration')->nullable()
                ->comment('Duration of availability in seconds');

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('asset_category_id')->references('id')->on('dz_categories');
            $table->foreign('asset_detail_id')->references('id')->on('dz_asset_details');
            $table->foreign('venue_id')->references('id')->on('dz_venues');

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
        Schema::dropIfExists('dz_asset_availabilities');
    }
}
