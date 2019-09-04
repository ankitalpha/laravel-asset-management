<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CreateDzAssetDetailsTable
 * @package Drivezy\LaravelAssetManager\Database\Migrations
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class CreateDzAssetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_asset_details', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('identifier')->nullable();
            $table->boolean('active')->default(false);

            $table->unsignedInteger('asset_category_id')->nullable();
            $table->unsignedInteger('home_venue_id')->nullable();

            $table->string('source_type')->nullable();
            $table->unsignedInteger('source_id')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('asset_category_id')->references('id')->on('dz_asset_categories');
            $table->foreign('home_venue_id')->references('id')->on('dz_venues');

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
        Schema::dropIfExists('dz_asset_details');
    }
}
