<?php

namespace App\Http\Controllers\Backend\Drugs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Drugs\ManageDrugsRequest;
use App\Http\Requests\Backend\Drugs\StoreDrugsRequest;
use App\Http\Requests\Backend\Drugs\UpdateDrugsRequest;
use App\Http\Responses\Backend\Drug\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Drug;
use App\Models\PreciptionType;
use App\Models\BlogTag;
use App\Models\DrugAttribute;
use App\Repositories\Backend\DrugsRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class DrugsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\DrugsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\DrugsRepository $blog
     */
    public function __construct(DrugsRepository $repository)
    {
        
        $this->repository = $repository;
        View::share('js', ['drugs']);
    }

    /**
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return ViewResponse
     */
    public function index(ManageDrugsRequest $request)
    {
        
        return new ViewResponse('backend.drugs.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return ViewResponse
     */
    public function create(ManageDrugsRequest $request, Drug $drug)
    {
        $preciption_type = PreciptionType::get()->pluck('preciption_type','id')->toArray();
        $formats = DrugAttribute::where('type','format')->pluck('name','id')->toArray();
        $strength_units = DrugAttribute::where('type','strength_unit')->pluck('name','id')->toArray();
        $pack_units = DrugAttribute::where('type','pack_unit')->pluck('name','id')->toArray();
        $insurance_coverage = DrugAttribute::where('type','insurance_coverage')->pluck('name','id')->toArray();
       
        return new ViewResponse('backend.drugs.create', [
            'status' => $drug->statuses,
            'formats'=>$formats,
            'strength_unit'=>$strength_units,
            'pack_unit'=>$pack_units,
            'insurance_coverage_in_percent'=>$insurance_coverage,
            'preciption_types_id'=>$preciption_type,
        ]);
    }

    

    /**
     * @param \App\Http\Requests\Backend\Drugs\StoreDrugsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreDrugsRequest $request)
    {

       
        if($request->insurance_coverage_in_percent){
            $per = $request->insurance_coverage_in_percent/100;
            $request->merge(['insurance_coverage_calculation_in_percent' => $per]); 
        }
       
       $this->repository->create($request->except(['_token', '_method','files']),$request->file('files'));
        
        return new RedirectResponse(route('admin.drugs.index'), ['flash_success' => __('alerts.backend.drugs.created')]);
    }

    /**
     * @param \App\Models\Drug $drug
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return \App\Http\Responses\Backend\Drug\EditResponse
     */
    public function edit(Drug $drug, ManageDrugsRequest $request)
    {
        $preciption_type = PreciptionType::get()->pluck('preciption_type','id')->toArray();
        $formats = DrugAttribute::where('type','format')->pluck('name','id')->toArray();
        $strength_units = DrugAttribute::where('type','strength_unit')->pluck('name','id')->toArray();
        $pack_units = DrugAttribute::where('type','pack_unit')->pluck('name','id')->toArray();
        $insurance_coverage = DrugAttribute::where('type','insurance_coverage')->pluck('name','id')->toArray();

        return new EditResponse($drug, $drug->statuses,$formats,$strength_units,$pack_units,$insurance_coverage,$preciption_type);
    }

    /**
     * @param \App\Models\Blogs\Drug $drug
     * @param \App\Http\Requests\Backend\Drugs\UpdateDrugsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Drug $drug, UpdateDrugsRequest $request)
    {
        if($request->insurance_coverage_in_percent){
            $per = $request->insurance_coverage_in_percent/100;
            $request->merge(['insurance_coverage_calculation_in_percent' => $per]); 
        }
        $this->repository->update($drug, $request->except(['_token', '_method','files']),$request->file('files'));

        return new RedirectResponse(route('admin.drugs.index'), ['flash_success' => __('alerts.backend.drugs.updated')]);
    }

    /**
     * @param \App\Models\Drug $drug
     * @param \App\Http\Requests\Backend\Drugs\ManageDrugsRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Drug $drug, ManageDrugsRequest $request)
    {
        $this->repository->delete($drug);

        return new RedirectResponse(route('admin.drugs.index'), ['flash_success' => __('alerts.backend.drugs.deleted')]);
    }
    public function delete_image($id){
        $d_data = $this->repository->delete_image($id);
        return $d_data;
    }
    public function create_attribute(Request $request){
        $d_data = $this->repository->create_attribute($request->all());
        return $d_data;
        // print_r($d_data);
        // die;
           
    }
    
}
