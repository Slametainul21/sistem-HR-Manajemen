<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesAndDepartmentsTables extends Migration
{
    public function up()
    {
        Schema::create('tbl_roles', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tbl_departments', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tbl_materials_departments', function (Blueprint $table) {
            $table->foreignId('material_id')->constrained('tbl_materials');
            $table->foreignId('department_id')->constrained('tbl_departments');
            $table->primary(['material_id', 'department_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_materials_departments');
        Schema::dropIfExists('tbl_departments');
        Schema::dropIfExists('tbl_roles');
    }
}