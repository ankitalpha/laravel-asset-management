<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CreateDzZonesTable
 * @package Drivezy\LaravelAssetManager\Database\Migrations
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class CreateDzZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_zones', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->string('name');
            $table->boolean('active')->default(false);

            $table->unsignedInteger('region_id')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('region_id')->references('id')->on('dz_regions');

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
        Schema::dropIfExists('dz_zones');
    }
}
