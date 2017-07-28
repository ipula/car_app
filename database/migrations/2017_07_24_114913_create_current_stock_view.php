<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentStockView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('	CREATE 
                VIEW current_stock AS
                SELECT 
                    service_material.service_material_id AS service_material_id,
                    service_material.service_material_name AS service_material_name,
                    service_material.service_material_low_qty AS service_material_low_qty,
                    service_material.service_material_unit_price AS service_material_unit_price,
                    (IF(ISNULL(grn_sum.pur_stock),
                    0,
                    grn_sum.pur_stock) - IF(ISNULL(material_sum.use_qty),
                    0,
                    material_sum.use_qty)) AS stock_qty
            FROM
                ((service_material
                LEFT JOIN grn_sum ON ((service_material.service_material_id = grn_sum.grn_detail_service_material_id)))
                LEFT JOIN material_sum ON ((service_material.service_material_id = material_sum.service_material_detail_service_material_id)))');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW material_sum');
    }
}
