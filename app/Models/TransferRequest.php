<?php

namespace App\Models;


class TransferRequest extends BaseModel
{


    
    public static function generateTransferNumber()
    {
        $date = now()->format('Ymd');
        $lastOrder = self::latest()->first();

        if ($lastOrder) {
            $lastNumber = $lastOrder->transfer_number;
            // $lastNumber = end($lastNumber);
            $nextNumber = str_pad($lastNumber + 1, 10, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '0000000001';
        }

        //return "ODR-$nextNumber";
        return "$nextNumber";
    }
    
}
