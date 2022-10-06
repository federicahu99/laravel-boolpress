<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            //foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); //cancello la categoria ma non i post

            // oppure
            // $table->foreingId('category_id')->nullable()->after('id')->onDelete('set null')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // elimino relazione 
            $table->dropForeign('posts_category_id_foreign');
            // elimino la colonna
            $table->dropColumn('category_id');
        });
    }
}
