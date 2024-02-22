<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Order;
use App\Repositories\BaseRepository;
use Str;

class OrdersRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Order::class;

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc')
    {
        return $this->query()
        
            ->select([
                'orders.id',
                'orders.order_number',
                'orders.total_amount',
                'orders.order_status',
                'orders.payment_status',
                'orders.user_id',
                'orders.created_at',
            ])
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
       return $this->query()->has('user')->select([
                'orders.id',
                'orders.order_number',
                'orders.total_amount',
                'orders.order_status',
                'orders.payment_status',
                'orders.user_id',
                'orders.created_at',
            ])->with('user')->orderBy('created_at', 'desc');
    }

   

}
