<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=OFF');

            Schema::create('order_items_new', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->string('product_name');
                $table->decimal('price', 10, 2);
                $table->unsignedInteger('quantity');
                $table->json('variant')->nullable();
                $table->timestamps();
            });

            DB::statement(
                'INSERT INTO order_items_new (id, order_id, product_id, product_name, price, quantity, variant, created_at, updated_at)
                 SELECT id, order_id, product_id, product_name, price, quantity, variant, created_at, updated_at FROM order_items'
            );

            Schema::drop('order_items');
            Schema::rename('order_items_new', 'order_items');

            DB::statement('PRAGMA foreign_keys=ON');
            return;
        }

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=OFF');

            Schema::create('order_items_old', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained()->cascadeOnDelete();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                $table->string('product_name');
                $table->decimal('price', 10, 2);
                $table->unsignedInteger('quantity');
                $table->json('variant')->nullable();
                $table->timestamps();
            });

            DB::statement(
                'INSERT INTO order_items_old (id, order_id, product_id, product_name, price, quantity, variant, created_at, updated_at)
                 SELECT id, order_id, product_id, product_name, price, quantity, variant, created_at, updated_at FROM order_items'
            );

            Schema::drop('order_items');
            Schema::rename('order_items_old', 'order_items');

            DB::statement('PRAGMA foreign_keys=ON');
            return;
        }

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable(false)->change();
        });
    }
};
