<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Drugs\DrugCreated;
use App\Events\Backend\Drugs\DrugDeleted;
use App\Events\Backend\Drugs\DrugUpdated;
use App\Exceptions\GeneralException;
use App\Models\Drug;
use App\Models\DrugImages;
use App\Models\DrugAttribute;
use App\Models\BlogCategory;
use App\Models\BlogMapCategory;
use App\Models\BlogMapTag;
use App\Models\BlogTag;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class DrugsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Drug::class;

    protected $upload_path;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'name',
        'available_form',
        'manufacturer_name',
        'generic_name',
        'strength',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'drug'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'owner',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'drugs.id',
                'drugs.brand_name',
                'drugs.generic_name',
                'drugs.main_therapeutic_use',
                'drugs.format_id',
                'drugs.manufacturer',
                'drugs.din',
                'drugs.pack_size',
                'drugs.upc',
                'drugs.pharmacy_purchase_price',
                'drugs.delivery_cost',
                'drugs.status',
                'drugs.created_at',
                'drugs.strength',
                'drugs.strength_unit_id',
                'drugs.pack_unit_id',
                'drugs.preciption_types_id',
                'drugs.insurance_coverage_in_percent',
                'drugs.insurance_coverage_calculation_in_percent',
                'drugs.dispensing_fee',
                'drugs.percent_markup',
                
                
                
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input,$files)
    {
        // print_r($input);
        // print_r('--------------------------------------------------------------');
        // print_r($files);
        // die();

        return DB::transaction(function () use ($input,$files) {

            // $input['strength'] = serialize($input['strength']);
            // $input['price'] = serialize($input['price']);
            if ($drug = Drug::create($input)) {

                    event(new DrugCreated($drug));
                        //print_r($files);
                        if(isset($files)){
                            if(count($files)>0){
                            foreach ($files as $key => $image) {
                                $uuid = Uuid::uuid4()->toString();
                                $drug_images = new DrugImages;
                                $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                                $destinationPath = public_path('img/backend/drugs');
                                $image->move($destinationPath, $fileName);
                                $front_url = 'img/backend/drugs/'.$fileName;
                                $drug_images->image = $front_url;
                                $drug_images->drug_id = $drug->id;
                                if($key==0){
                                    $drug_images->type = 'default';
                                }
                                $drug_images->save();
                            

                            }
                        }
                    }
                    return $drug;
                }

            throw new GeneralException(__('exceptions.backend.drugs.create_error'));
        });
    }

    /**
     * @param \App\Models\Drug $drug
     * @param array $input
     */
    public function update(Drug $drug, array $input,$files)
    {


        return DB::transaction(function () use ($drug, $input,$files) {

            if ($drug->update($input)) {


                event(new DrugUpdated($drug));
                // print_r($files );
                //         die;
                if(isset($files)){
                    if(count($files)>0){
                    foreach ($files as $key => $image) {
                        $uuid = Uuid::uuid4()->toString();
                        $drug_images = new DrugImages;
                        $fileName   = $uuid . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('img/backend/drugs');
                        $image->move($destinationPath, $fileName);
                        $front_url = 'img/backend/drugs/'.$fileName;
                        $drug_images->image = $front_url;
                        $drug_images->drug_id = $drug->id;
                        if($key==0){
                            $drug_images->type = 'default';
                        }
                        $drug_images->save();
                    

                    }
                    $all_drug_images = DrugImages::where('drug_id',$drug->id)->get();
                    if(count($all_drug_images)>0){
                        DrugImages::where('drug_id',$drug->id)
                        ->update(['type' => null]);
                        $m = DrugImages::where('drug_id',$drug->id)->orderBy('id', 'ASC')->take(1)->first();
                        $m->type = 'default';
                        $m->save();
                        // print_r($m );
                        // die;
                    }
                  
                    
                    
                   
                }
            }

                return $drug->fresh();
            }

            throw new GeneralException(__('exceptions.backend.drugs.update_error'));
        });
    }



    /**
     * @param \App\Models\Drugs\Drug $drug
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Drug $drug)
    {
        DB::transaction(function () use ($drug) {
            if ($drug->delete()) {

                event(new DrugDeleted($drug));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.drugs.delete_error'));
        });
    }

  

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        $fileName = $model->featured_image;

        return $this->storage->delete($this->upload_path.$fileName);
    }

    

    public function delete_image($id)
    {

        $d_image = DrugImages::where('id',$id)->first();
        

        if ($d_image->forceDelete()) {
           

            return $id;
        }
        // $fileName = $model->featured_image;

        // return $this->storage->delete($this->upload_path.$fileName);
    }

    public function create_attribute($input)
    {
        // print_r($input);
        // die;
        $drug_attribute =  DrugAttribute::where('name',$input['name'])->where('type',$input['type'])->first();
        if ($drug_attribute === null) {
         $new_attribule = new DrugAttribute();
         $new_attribule->name = $input['name'];
         $new_attribule->type = $input['type'];
         $new_attribule->created_by = auth()->user()->id;
         if($new_attribule->save()){
            //$drug_data = DrugAttribute::where('id',$new_attribule->id)->pluck('name','id')->toArray();
            // print_r($new_attribule);
            // die;
            
           return json_encode([
            'message'=>'yes',
            'id'=>$new_attribule->id,
            'name'=>$new_attribule->name,
           ]);
         }
         return json_encode(['message'=>'no']);
         }
         return json_encode(['message'=>'no']);
        
    }
    
}
