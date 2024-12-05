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
        $procedimiento = "DROP PROCEDURE IF EXISTS `get_reporte_venta_by_date`;
        CREATE PROCEDURE `get_reporte_venta_by_date`(IN `fecha_ini` DATE, `fecha_fin` DATE) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER
        BEGIN
            SELECT venta_detalles.id_producto, productos.nombre, productos.item_producto, productos.precio_venta AS precio_unitario, marcas.detalle AS marca,productos.medida,productos.calidad,productos.unidad,SUM(venta_detalles.cantidad) AS ventas_totales, (productos.precio_venta * (SUM(venta_detalles.cantidad))) AS total FROM `venta_detalles` JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id` JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id` JOIN `marcas` ON `productos`.`id_marca` = `marcas`.`id` WHERE `venta_detalles`.`isDeleted` = 0 AND `venta_cabeceras`.`fecha_venta` BETWEEN fecha_ini AND fecha_fin GROUP BY venta_detalles.id_producto, productos.nombre, productos.item_producto, precio_unitario, marca,productos.medida,productos.calidad,productos.unidad;
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
        //
    }
};
