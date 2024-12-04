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
        $procedimiento = "DROP PROCEDURE IF EXISTS `get_reporte_venta_by_arg`;
        CREATE PROCEDURE `get_reporte_venta_by_arg`(IN `ARG` VARCHAR(25)) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER
        BEGIN
            DECLARE fecha_hoy DATE DEFAULT '2023-01-01';
            DECLARE fecha DATE;
            SET fecha_hoy = CURDATE();
            IF ARG = 'all' THEN
            	SET fecha = DATE_SUB(fecha_hoy, INTERVAL 10 YEAR);
            END IF;
            IF ARG = 'hoy' THEN
                SET fecha = fecha_hoy;
            END IF;
            IF ARG = 'sem' THEN
                SET fecha = DATE_SUB(fecha_hoy, INTERVAL 7 DAY);
            END IF;
            IF ARG = 'mes' THEN
                SET fecha = DATE_SUB(fecha_hoy, INTERVAL 1 MONTH);
            END IF;

            SELECT venta_detalles.id_producto, productos.nombre, productos.item_producto, productos.precio_venta AS precio_unitario, marcas.detalle AS marca,productos.medida,productos.calidad,productos.unidad,SUM(venta_detalles.cantidad) AS ventas_totales, (productos.precio_venta * (SUM(venta_detalles.cantidad))) AS total FROM `venta_detalles` JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id` JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id` JOIN `marcas` ON `productos`.`id_marca` = `marcas`.`id` WHERE `venta_cabeceras`.`fecha_venta` >= fecha AND `venta_detalles`.`isDeleted` = 0 GROUP BY `venta_detalles`.`id_producto`;
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
