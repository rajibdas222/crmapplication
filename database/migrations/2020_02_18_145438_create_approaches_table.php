<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApproachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approaches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userID')->nullable()->comment('user_id');
            $table->string('class_data')->nullable()->comment('区分');
            $table->string('j_code')->nullable()->comment('Jコード');
            $table->string('responsible')->nullable()->comment('担当者');
            $table->string('wholesaler_kana')->nullable()->comment('問屋カナ');
            $table->string('wholesaler_name')->nullable()->comment('問屋名称');
            $table->string('charges')->nullable()->comment('課金内容');
            $table->string('invoice_name')->nullable()->comment('確定名称');
            $table->string('department')->nullable()->comment('部署');
            $table->string('tel')->nullable()->comment('電話');
            $table->string('fax')->nullable()->comment('FAX');
            $table->string('zip_code')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->string('address2')->nullable()->comment('住所2');
            $table->string('basic_rate')->nullable()->comment('基本料金');
            $table->string('line_rate')->nullable()->comment('行明細');
            $table->string('super_code')->nullable()->comment('スーパーコード');
            $table->string('super_name')->nullable()->comment('スーパー名');
            $table->string('lease_class')->nullable()->comment('リース区分');
            $table->string('id_3')->nullable()->comment('id_3');
            $table->string('system')->nullable()->comment('システム');
            $table->string('maturity_date')->nullable()->comment('満期日');
            $table->string('sales_staff')->nullable()->comment('営業担当');
            $table->string('contract_date')->nullable()->comment('契約日');
            $table->string('cancelle_date')->nullable()->comment('解約日');
            $table->string('period_data')->nullable()->comment('契約期間');
            $table->string('contract_renewal')->nullable()->comment('契約更新');
            $table->string('cancel_reason')->nullable()->comment('解約理由');
            $table->string('cancelle_reception_date')->nullable()->comment('解約受付日');
            $table->string('management_nb')->nullable()->comment('備考（経理');
            $table->string('sales_nb')->nullable()->comment('備考（営業');
            $table->string('support_nb')->nullable()->comment('備考(支援');
            $table->string('customer_code')->nullable()->comment('取引先コード');
            $table->string('month_payment')->nullable()->comment('前月入金');
            $table->string('month_sales')->nullable()->comment('売上');
            $table->string('month_balance')->nullable()->comment('残高');
            $table->string('automatic_transfer')->nullable()->comment('自振');
            $table->string('zennginn')->nullable();
            $table->string('pit')->nullable();
            $table->string('kadou')->nullable();
            $table->string('torihikisaki_itirann')->nullable();
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Time of creation');
            $table->dateTime('modified')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('Time of Update');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approaches');
    }
}
