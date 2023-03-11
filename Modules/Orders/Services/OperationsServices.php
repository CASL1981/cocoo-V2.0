<?php

namespace Modules\Orders\Services;

use Modules\Basics\Entities\Classification;
use Modules\Basics\Entities\Client;
use Modules\Basics\Entities\Payment;
use Modules\Basics\Entities\TypePrice;
use Modules\Orders\Entities\DetailOperation;
use Modules\Orders\Entities\Operation;

class OperationsServices
{
    public function addFillableValidation($validate, $client_id, $payment_id, $type_price_id, $classification_id)
    {
        $client_name = Client::whereId($client_id)->first();
        $payment_name = Payment::whereId($payment_id)->first();
        $typeprice_name = TypePrice::whereId($type_price_id)->first();
        $classification_name = Classification::whereId($classification_id)->first();
        
        return $validate = array_merge($validate, [
            'basic_client_name' => $client_name->client_name,
            'basic_payment_name' => $payment_name->name,
            'basic_type_price_name' => $typeprice_name->name,
            'basic_classification_name' => $classification_name->name,
        ]);
    }

    public function validateProcessOrder($selected_id, $selectedModel)
    {
        $operation = Operation::find($selected_id);
        $status = Operation::withTrashed()->whereIn('id', $selectedModel)->get('status')->toArray();
        
        if($operation && $status[0]['status'] === 'Open') {
            $operation->update([ 'status' => 'Completed' ]); //actualizamos el estado de los modelos
            DetailOperation::where('order_operation_id',$selected_id)->update([ 'status' => 'Completed' ]); //actualizamos el estado de los registros del detalle de ordenes            
            return true;
        }
    }

    public function validateReverseOrder($selected_id)
    {
        $product = Operation::withTrashed()->find($selected_id);
        
        if($product->deleted_by || $product->status == 'Completed') {
            $product->update([ 'deleted_by' => NULL, 'status' => 'Open' ]); //actualizamos el estado de los modelos
            $product->restore(); //reversamos la eliminación con softdelete
            DetailOperation::where('order_operation_id',$selected_id)->update([ 'status' => 'Open' ]); //actualizamos el estado de los registros del detalle de ordenes
            return true;
        }  
    }
}