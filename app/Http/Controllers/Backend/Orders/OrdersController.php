<?php

namespace App\Http\Controllers\Backend\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Orders\ManageOrdersRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Order;
use App\Repositories\Backend\OrdersRepository;
use Illuminate\Support\Facades\View;
use App\Models\Drug;


class OrdersController extends Controller
{
    /**
     * @var \App\Repositories\Backend\OrdersRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\OrdersRepository $order
     */
    public function __construct(OrdersRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['all-orders']);
    }

    /**
     * @param \App\Http\Requests\Backend\Orders\ManageOrdersRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageOrdersRequest $request)
    {
        return new ViewResponse('backend.orders.index');
    }

    
    
}
