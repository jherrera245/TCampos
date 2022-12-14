<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTriggerUpdateStockIngreso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_update_stock_ingreso');
        DB::unprepared(
            'CREATE TRIGGER trigger_update_stock_ingreso AFTER INSERT ON detalle_ingresos FOR EACH 
            ROW BEGIN
                UPDATE productos SET stock = stock + NEW.cantidad
                WHERE productos.id = NEW.id_producto;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_update_stock_ingreso');
    }
}
