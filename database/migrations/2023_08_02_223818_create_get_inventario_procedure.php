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
        $procedimiento = "DROP PROCEDURE IF EXISTS `get_inventario_by_productid`; CREATE PROCEDURE `get_inventario_by_productid` () 
        BEGIN 
        SELECT a.id, a.item_producto, a.descripcion, b.detalle AS categoria, d.detalle AS marca, a.color, a.unidad, a.precio_compra, a.precio_venta, ((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE id_producto = a.id) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE id_producto = a.id)) AS existencias FROM `productos` AS a INNER JOIN `categorias` AS b ON b.id = a.id_categoria INNER JOIN `almacens` AS c ON c.id = a.id_almacen INNER JOIN `marcas` AS d ON d.id = a.id_marca WHERE a.isDeleted = 0; END";
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
