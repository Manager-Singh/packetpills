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
            ->addColumn('full_name', function ($transfer_requests) {
                return (isset($transfer_requests->owner->full_name)) ? $transfer_requests->owner->full_name : '' ;
             })
             ->addColumn('date_of_birth', function ($transfer_requests) {
                return (isset($transfer_requests->owner->date_of_birth)) ? $transfer_requests->owner->date_of_birth : '' ;
               
             })
             ->addColumn('mobile_no', function ($transfer_requests) {
                return (isset($transfer_requests->owner->mobile_no)) ? $transfer_requests->owner->mobile_no : '' ;
            })
            ->addColumn('name', function ($transfer_requests) {
               return $transfer_requests->name;
            })
            ->addColumn('formatted_address', function ($transfer_requests) {
                return $transfer_requests->formatted_address;
            })
            ->addColumn('formatted_phone_number', function ($transfer_requests) {
                return $transfer_requests->formatted_phone_number;
            })
            ->addColumn('fax_number', function ($transfer_requests) {
                if(empty($transfer_requests->fax_number)){
                    return '<div class="add-fax-no"><button type="button" onclick="faxnumberUpdate('.$transfer_requests->id.')" class="btn btn-primary btn-sm">Add Fax</button></div>';
                }else{
                    return $transfer_requests->fax_number.'<div class="add-fax-no"><button type="button" onclick="faxnumberUpdate('.$transfer_requests->id.','.$transfer_requests->fax_number.')" class="btn btn-success btn-sm">Edit Fax</button></div>';
                }
            })
            ->addColumn('created_at', function ($transfer_requests) {
                return $transfer_requests->created_at->toDateString();
            })
            ->addColumn('status', function ($transfer_requests) {
                $html ='';
                $html .='<select class="form-control transferStatus box-size" id="transferStatus-'.$transfer_requests->id.'" onchange="transferStatusChange('.$transfer_requests->id.')" data-placeholder="Transfer Status" name="status"><option value="pending"';
                if($transfer_requests->status == 'pending'){
                    $html .= 'selected';
                }
                $html .='>Pending</option><option value="approved"';
                
                if($transfer_requests->status == 'approved'){
                    $html .= 'selected';
                }
                
                $html .='>Approved</option><option value="cancelled"';

                if($transfer_requests->status == 'cancelled'){
                    $html .= 'selected';
                }
                
                $html .= '>Cancelled</option><option value="declined"';
                if($transfer_requests->status == 'declined'){
                    $html .= 'selected';
                }
                $html .='>Declined</option><option value="processing"';
                if($transfer_requests->status == 'processing'){
                    $html .= 'selected';
                }
                $html .='>Processing</option></select>';
                return $html;
            })
            ->make(true);
            
    }
}
