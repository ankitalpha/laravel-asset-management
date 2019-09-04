<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CreateDzAddressDetailsTable
 * @package Drivezy\LaravelAssetManager\Migrations
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class CreateDzAddressDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_address_details', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('postal_code')->nullable();

            $table->string('street_address')->nullable();
            $table->string('house_address');

            $table->double('latitude', 10, 8)->nullable();
            $table->double('longitude', 10, 7)->nullable();

            $table->string('source_type')->nullable();
            $table->unsignedInteger('source_id')->nullable();

            $table->unsignedInteger('address_type_id')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('address_type_id')->references('id')->on('dz_lookup_types');
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
        Schema::dropIfExists('dz_address_details');
    }
}
