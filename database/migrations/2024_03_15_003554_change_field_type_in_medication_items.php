<?php
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldTypeInMedicationItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication_items', function (Blueprint $table) {
            //
            if (!Type::hasType('double')) {
                Type::addType('double', 'Doctrine\DBAL\Types\FloatType');
            }
            $table->double('price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medication_items', function (Blueprint $table) {
            //
           $table->double('price')->change();
        });
    }
}
