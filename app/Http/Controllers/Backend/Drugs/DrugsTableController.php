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
            ->addColumn('status', function ($drugs) {
                return $drugs->status;
            })
            ->addColumn('generic_name', function ($drugs) {
                return $drugs->generic_name;
            })
            ->addColumn('main_therapeutic_use', function ($drugs) {
                return $drugs->main_therapeutic_use;
            })
            ->addColumn('strength', function ($drugs) {
               return implode(', ',unserialize($drugs->strength));
               // return $drugs->strength;
            })
            ->addColumn('strength_unit', function ($drugs) {
                return $drugs->strength_unit;
            })
            ->addColumn('format', function ($drugs) {
                return $drugs->format;
            })
            ->addColumn('manufacturer', function ($drugs) {
                return $drugs->manufacturer;
            })
            ->addColumn('pack_size', function ($drugs) {
                return $drugs->pack_size;
            })
            ->addColumn('pack_unit', function ($drugs) {
                return $drugs->pack_unit;
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
            ->addColumn('pharmacy_purchase_price', function ($drugs) {
                return $drugs->pharmacy_purchase_price;
            })
            ->addColumn('percent_markup', function ($drugs) {
                return $drugs->percent_markup;
            })
            ->addColumn('drug_cost', function ($drugs) {
                return $drugs->drug_cost;
            })
            ->addColumn('dispensing_fee', function ($drugs) {
                return $drugs->dispensing_fee;
            })
            ->addColumn('insurance_coverage_in_percent', function ($drugs) {
                return $drugs->insurance_coverage_in_percent;
            })
            ->addColumn('insurance_coverage_calculation_in_percent', function ($drugs) {
                return $drugs->insurance_coverage_calculation_in_percent;
            })
            ->addColumn('delivery_cost', function ($drugs) {
                return $drugs->delivery_cost;
            })
            ->addColumn('patient_pays', function ($drugs) {
                return $drugs->patient_pays;
            })
            ->addColumn('drug_indication', function ($drugs) {
                return $drugs->drug_indication;
            })
            ->addColumn('standard_dosage', function ($drugs) {
                return $drugs->standard_dosage;
            })
            ->addColumn('side_effect', function ($drugs) {
                return $drugs->side_effect;
            })
            ->addColumn('contraindications', function ($drugs) {
                return $drugs->contraindications;
            })
            ->addColumn('precautions', function ($drugs) {
                return $drugs->precautions;
            })
            ->addColumn('warnings', function ($drugs) {
                return $drugs->warnings;
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

