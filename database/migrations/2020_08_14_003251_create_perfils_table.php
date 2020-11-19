<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable(true);
            $table->string('telefono')->nullable(true);
            $table->text('titulo')->nullable(true);
            $table->text('acerca_de_mi')->nullable(true);
            $table->string('cv')->nullable(true);
            $table->string('educacion')->nullable(true);
            $table->string('especialidad')->nullable(true);
            $table->string('idiomas')->nullable(true);
            $table->string('trabajo')->nullable(true);
            $table->string('direccion')->nullable(true);
            $table->string('colonia')->nullable(true);
            $table->date('fecha_de_nacimiento')->nullable(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('resenas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->text('contenido');
            $table->foreignId('autor')->nullable()->constrained()->onDelete('cascade')->references('id')->on('users');
            $table->foreignId('receptor')->nullable()->constrained()->onDelete('cascade')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('dato_bancarios', function (Blueprint $table) {
            $table->id();
            $table->string('direccion')->nullable(true);
            $table->string('colonia')->nullable(true);
            $table->integer('codigo_postal')->nullable(true);
            $table->foreignId('estado_id')->nullable()->constrained();
            $table->string('propietario_tarjeta')->nullable(true);
            $table->integer('numero_tarjeta')->nullable(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('perfils');
        Schema::dropIfExists('resenas');
    }
}
