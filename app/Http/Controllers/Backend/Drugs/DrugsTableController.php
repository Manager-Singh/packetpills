<?php

namespace App\Http\Controllers\Backend\Drugs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Drugs\ManageDrugsRequest;
use App\Repositories\Backend\DrugsRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class DrugsTableController.
 */
class DrugsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\DrugsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\DrugsRepository $repository
     */
    public function __construct(DrugsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageDrugsRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['brand_name'])
            ->addColumn('display_status', function ($drugs) {
                return $drugs->display_status;
            })
            ->addColumn('drug_image', function ($drugs) {

              $imgurl ='';
                if(count($drugs->images)>0){
                    foreach ($drugs->images as $image){
                        if($image->type=='default'){
                            $imgurl = '<img class="listing-image" src="'.asset($image->image).'" width=90 height=90>';
                        }
                    }
                    
                    return $imgurl;
                }else{
                    $imgurl = '<img class="listing-image" src="http://via.placeholder.com/640x360" width=90 height=90>';
                    return $imgurl;
                }
               
            })
            ->addColumn('generic_name', function ($drugs) {
                return $drugs->generic_name;
            })
            ->addColumn('main_therapeutic_use', function ($drugs) {
                return $drugs->main_therapeutic_use;
            })
            ->addColumn('drug_strength', function ($drugs) {
                
               return $drugs->drug_strength.' '.$drugs->strenthUnit->name;
            })
            ->addColumn('format_id', function ($drugs) {
                return $drugs->format->name;
            })
            ->addColumn('manufacturer', function ($drugs) {
                return $drugs->manufacturer;
            })
            ->addColumn('drug_pack', function ($drugs) {
                return $drugs->drug_pack .' '.$drugs->packSize->name;
            })
            ->addColumn('din', function ($drugs) {
                return $drugs->din;
            })
            ->addColumn('presciption_required', function ($drugs) {
                return $drugs->presciption_required;
            })
            ->addColumn('upc', function ($drugs) {
                return $drugs->upc;
            })
            // ->addColumn('pharmacy_purchase_price', function ($drugs) {
            //     return $drugs->pharmacy_purchase_price;
            // })
            ->addColumn('drug_cost', function ($drugs) {
                return $drugs->drug_cost;
            })
            // ->addColumn('dispensing_fee', function ($drugs) {
            //     return $drugs->dispensing_fee;
            // })
            ->addColumn('insurance_coverage_in_percent', function ($drugs) {
                return $drugs->insurance_coverage_in_percent;
            })
            // ->addColumn('delivery_cost', function ($drugs) {
            //     return $drugs->delivery_cost;
            // })
            ->addColumn('patient_pays', function ($drugs) {
                return $drugs->patient_pays;
            })
            ->addColumn('created_at', function ($drugs) {
                return $drugs->created_at->toDateString();
            })
            ->addColumn('actions', function ($drugs) {
                return $drugs->action_buttons;
            })
            ->make(true);
    }
}

