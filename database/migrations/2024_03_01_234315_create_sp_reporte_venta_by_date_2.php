<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // cambiar esto para que muestre un listado de todas las compras no agrupadas por producto
        $procedimiento = "DROP PROCEDURE IF EXISTS `get_reporte_venta_by_date`;
        CREATE PROCEDURE `get_reporte_venta_by_date`(IN `fecha` DATE) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER
        BEGIN
            SELECT productos.nombre, productos.item_producto, venta_detalles.precio_unitario, SUM(venta_detalles.cantidad) AS ventas_totales, (venta_detalles.precio_unitario * (SUM(venta_detalles.cantidad))) AS total FROM `venta_detalles` JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id` JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id` WHERE `venta_cabeceras`.`fecha_venta` = fecha AND `venta_detalles`.`isDeleted` = 0 GROUP BY `productos`.`nombre`,`productos`.`item_producto`;
        END;";
        DB::unprepared($procedimiento);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sp_reporte_venta_by_date_2');
    }
};
