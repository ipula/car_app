<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialSum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE 
                    VIEW material_sum AS
                        SELECT 
                            service_material_detail.service_material_detail_service_material_id AS service_material_detail_service_material_id,
                            SUM(service_material_detail.service_material_detail_qty) AS use_qty,
                            TRUNCATE(SUM((service_material_detail.service_material_detail_qty * service_material_detail.service_material_unit_price)),
                                2) AS income
                        FROM
                            (service_material_detail
                            JOIN job_card ON ((service_material_detail.service_material_detail_job_card_id = job_card.job_card_id)))
                        GROUP BY service_material_detail.service_material_detail_service_material_id');
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
