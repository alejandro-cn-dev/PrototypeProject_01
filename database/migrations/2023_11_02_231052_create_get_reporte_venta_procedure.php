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
        $procedimiento = "DROP PROCEDURE IF EXISTS `get_reporte_venta_by_arg`;
        CREATE PROCEDURE `get_reporte_venta_by_arg`(IN `ARG` VARCHAR(25)) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER 
        BEGIN
            DECLARE fecha_hoy DATE DEFAULT '2023-01-01';
            DECLARE fecha DATE;
            SET fecha_hoy = CURDATE();
            IF ARG = 'hoy' THEN
                SET fecha = fecha_hoy;
            END IF;
            IF ARG = 'sem' THEN
                SET fecha = DATE_SUB(fecha_hoy, INTERVAL 7 DAY);
            END IF;
            IF ARG = 'mes' THEN
                SET fecha = DATE_SUB(fecha_hoy, INTERVAL 1 MONTH);
            END IF;
            
            SELECT productos.nombre, productos.item_producto, venta_detalles.precio_unitario, SUM(venta_detalles.cantidad) AS ventas_totales, (venta_detalles.precio_unitario * (SUM(venta_detalles.cantidad))) AS total FROM `venta_detalles` JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id` JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id` WHERE `venta_cabeceras`.`fecha_venta` >= fecha AND `venta_detalles`.`isDeleted` = 0 GROUP BY `productos`.`id`; 
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
