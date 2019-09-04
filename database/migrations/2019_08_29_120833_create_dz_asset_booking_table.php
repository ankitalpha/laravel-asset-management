<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CreateDzAssetBookingTable
 * @package Drivezy\LaravelAssetManager\Migrations
 *
 * @see https://github.com/drivezy/laravel-asset-manager
 * @author Ankit Tiwari <ankit19.alpha@gmail.com>
 */
class CreateDzAssetBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create('dz_asset_booking', function (Blueprint $table)
        {
            $userTable = LaravelUtility::getUserTable();

            $table->bigIncrements('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('asset_detail_id')->nullable();

            $table->string('reference_number')->unique();

            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->unsignedInteger('pickup_venue_id');
            $table->unsignedInteger('drop_venue_id');

            $table->unsignedInteger('pickup_address_id')->nullable();
            $table->unsignedInteger('drop_address_id')->nullable();

            $table->unsignedInteger('type_id');
            $table->unsignedInteger('status_id')->nullable();

            $table->decimal('amount')->default(1.0);
            $table->dateTime('confirmed_at')->nullable();

            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->foreign('user_id')->references('id')->on($userTable);
            $table->foreign('asset_detail_id')->references('id')->on('dz_asset_details');

            $table->foreign('pickup_venue_id')->references('id')->on('dz_venues');
            $table->foreign('drop_venue_id')->references('id')->on('dz_venues');

            $table->foreign('pickup_address_id')->references('id')->on('dz_address_details');
            $table->foreign('drop_address_id')->references('id')->on('dz_address_details');

            $table->foreign('type_id')->references('id')->on('dz_lookup_values');
            $table->foreign('status_id')->references('id')->on('dz_lookup_values');

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
        Schema::dropIfExists('dz_asset_booking');
    }
}
