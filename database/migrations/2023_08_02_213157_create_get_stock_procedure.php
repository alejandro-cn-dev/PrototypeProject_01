<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedimiento = "DROP PROCEDURE IF EXISTS `get_stock_by_productid`; CREATE PROCEDURE `get_stock_by_productid`(IN `idx` INT, OUT `stock` INT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN SET stock = (SELECT COALESCE(SUM(cantidad),0) FROM `compra_detalles` WHERE id_producto = idx AND isDeleted = 0) - (SELECT COALESCE(SUM(cantidad),0) FROM `venta_detalles` WHERE id_producto = idx AND isDeleted = 0); END";
        DB::unprepared($procedimiento);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
