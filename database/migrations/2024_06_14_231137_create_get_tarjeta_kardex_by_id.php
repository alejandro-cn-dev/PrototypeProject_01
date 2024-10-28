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
        $procedimiento = "DROP PROCEDURE IF EXISTS `sp_get_detalle_ficha_kardex`;
        CREATE PROCEDURE `sp_get_detalle_ficha_kardex`(IN `producto` INT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER
        BEGIN
        	SET @INV_INICIAL = 0;
            SET @INV_FINAL = 0;
			SELECT T.id, T.fecha, T.descripcion, T.numeracion, T.inv_inicial, T.costo_unitario, T.entrada, T.salida, T.inv_final
			FROM (
                SELECT id, fecha, descripcion, numeracion, costo_unitario,
                  CASE
                    WHEN descripcion = 'COMPRA' THEN
                		@INV_FINAL := @INV_FINAL + cantidad
                    WHEN descripcion = 'VENTA' THEN
                		@INV_FINAL := @INV_FINAL - cantidad
                  END,
                  @INV_FINAL AS inv_final,
                  CASE
                    WHEN descripcion = 'COMPRA' THEN
                		@INV_INICIAL := @INV_FINAL - cantidad
                    WHEN descripcion = 'VENTA' THEN
                		@INV_INICIAL := @INV_FINAL + cantidad
                  END,
                  @INV_INICIAL AS inv_inicial,
                  IF(descripcion = 'COMPRA',cantidad,'') AS entrada,
                  IF(descripcion = 'VENTA',cantidad,'') AS salida
                FROM (
                    SELECT compra_cabeceras.id as id, CONCAT(compra_cabeceras.fecha_compra,' ',compra_cabeceras.hora_compra) AS fecha, 'COMPRA' AS descripcion, compra_cabeceras.numeracion AS numeracion, productos.nombre AS producto, compra_detalles.costo_compra AS costo_unitario, compra_detalles.cantidad AS cantidad FROM compra_detalles
                    JOIN `compra_cabeceras` ON `compra_detalles`.`id_compra` = `compra_cabeceras`.`id`
                    JOIN `productos` ON `compra_detalles`.`id_producto` = `productos`.`id`
                    WHERE `productos`.`id` = producto AND `compra_cabeceras`.`isDeleted` = 0
                    UNION
                    SELECT venta_cabeceras.id as id, CONCAT(venta_cabeceras.fecha_venta,' ',venta_cabeceras.hora_venta) AS fecha, 'VENTA' AS descripcion, venta_cabeceras.numeracion AS numeracion, productos.nombre AS producto, venta_detalles.precio_unitario AS costo_unitario, venta_detalles.cantidad AS cantidad FROM venta_detalles
                    JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id`
                    JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id`
                    WHERE `productos`.`id` = producto AND `venta_cabeceras`.`isDeleted` = 0
                ) U
            	ORDER BY U.fecha
            ) T;
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
        Schema::dropIfExists('sp_get_detalle_ficha_kardex');
    }
};
