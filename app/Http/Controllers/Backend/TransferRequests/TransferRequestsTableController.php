<?php

namespace App\Http\Controllers\Backend\TransferRequests;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TransferRequests\ManageTransferRequest;
use App\Repositories\Backend\TransferRequestsRepository;
use Yajra\DataTables\Facades\DataTables;

class TransferRequestsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\TransferRequestsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\TransferRequestsRepository $repository
     */
    public function __construct(TransferRequestsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\TransferRequests\ManageTransferRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageTransferRequest $request)
    {
        
        
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('name', function ($transfer_requests) {
               
                return $transfer_requests->name;
            })
            ->addColumn('formatted_address', function ($transfer_requests) {
                return $transfer_requests->formatted_address;
            })
            ->addColumn('formatted_phone_number', function ($transfer_requests) {
                return $transfer_requests->formatted_phone_number;
            })
            ->addColumn('created_at', function ($transfer_requests) {
                return $transfer_requests->created_at->toDateString();
            })
            
            ->make(true);
            
    }
}
