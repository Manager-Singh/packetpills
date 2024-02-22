<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Orders\ManageOrdersRequest;
use App\Repositories\Backend\OrdersRepository;
use Yajra\DataTables\Facades\DataTables;

class OrdersTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\OrdersRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\OrdersRepository $repository
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Orders\ManageOrdersRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageOrdersRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('order_number', function ($orders) {
                return $orders->order_number;
            })
            ->addColumn('total_amount', function ($orders) {
                return $orders->total_amount;
            })
            ->addColumn('order_status', function ($orders) {
                return $orders->order_status;
            })
            ->addColumn('payment_status', function ($orders) {
                return $orders->payment_status;
            })
            ->addColumn('created_at', function ($orders) {
                return $orders->created_at->toDateString();
            })
            ->addColumn('actions', function ($orders) {
                return $orders->action_buttons;
            })
            ->make(true);
    }
}
