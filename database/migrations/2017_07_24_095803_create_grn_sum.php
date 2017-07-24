<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrnSum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW grn_sum AS
               SELECT 
                    grn_detail.grn_detail_service_material_id AS grn_detail_service_material_id,
                    SUM(grn_detail.grn_detail_qty) AS pur_stock,
                    grn_detail.grn_detail_type AS grn_detail_type,
                    TRUNCATE(SUM((((grn_detail.grn_detail_qty * grn_detail.grn_detail_pur_unit_price) * (100 - grn.grn_discount)) / 100)),
                        2) AS expenses
                FROM
                    (grn_detail
                    JOIN grn ON ((grn.grn_id = grn_detail.grn_detail_grn_id)))
                WHERE
                    (grn_detail.grn_detail_type = 1)
                GROUP BY grn_detail.grn_detail_service_material_id');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW grn_sum');
    }

}
