<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cart_shipping_rates', function (Blueprint $table) {
            if (!Schema::hasColumn('cart_shipping_rates', 'price_incl_tax')) {
                $table->decimal('price_incl_tax', 12, 4)->default(0)->after('is_calculate_tax');
            }
            if (!Schema::hasColumn('cart_shipping_rates', 'base_price_incl_tax')) {
                $table->decimal('base_price_incl_tax', 12, 4)->default(0)->after('price_incl_tax');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_shipping_rates', function (Blueprint $table) {
            if (Schema::hasColumn('cart_shipping_rates', 'price_incl_tax')) {
                $table->dropColumn('price_incl_tax');
            }
            if (Schema::hasColumn('cart_shipping_rates', 'base_price_incl_tax')) {
                $table->dropColumn('base_price_incl_tax');
            }
        });
    }
};
