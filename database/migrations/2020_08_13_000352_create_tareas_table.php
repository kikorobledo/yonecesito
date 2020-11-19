<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion')->nullable();
            $table->string('colonia')->nullable();
            $table->foreignId('estado_id')->constrained();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('descripcion');
            $table->date('fecha_de_vencimiento');
            $table->integer('presupuesto');
            $table->string('estatus');
            $table->string('tipo');
            /* $table->foreignId('categoria_id')->constrained(); */
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('trabajador')->nullable()->constrained()->onDelete('cascade')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('tareas');
    }
}
