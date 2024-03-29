<?php

namespace Modules\Basics\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Basics\Entities\Sequence;

class SequenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $sequence = new Sequence;
        $sequence->document = 'OC';
        $sequence->document_name = 'ORDENES DE COMPRA';
        $sequence->modelo = 'Operation';
        $sequence->number = '3059';
        $sequence->save();

        $sequence = new Sequence;
        $sequence->document = 'OS';
        $sequence->document_name = 'ORDENES DE SERVICIO';
        $sequence->modelo = 'Operation';
        $sequence->number = '1592';
        $sequence->save();
    }
}
