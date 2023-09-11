<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Drugs\DrugCreated;
use App\Events\Backend\Drugs\DrugDeleted;
use App\Events\Backend\Drugs\DrugUpdated;
use App\Exceptions\GeneralException;
use App\Models\Drug;
use App\Models\BlogCategory;
use App\Models\BlogMapCategory;
use App\Models\BlogMapTag;
use App\Models\BlogTag;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                'drugs.strength',
                'drugs.strength_unit',
                'drugs.format',
                'drugs.manufacturer',
                'drugs.pack_size',
                'drugs.pack_unit',
                'drugs.din',
                'drugs.presciption_required',
                'drugs.upc',
                'drugs.pharmacy_purchase_price',
                'drugs.percent_markup',
                'drugs.drug_cost',
                'drugs.dispensing_fee',
                'drugs.insurance_coverage_in_percent',
                'drugs.insurance_coverage_calculation_in_percent',
                'drugs.delivery_cost',
                'drugs.patient_pays',
                'drugs.drug_indication',
                'drugs.standard_dosage',
                'drugs.side_effect',
                'drugs.contraindications',
                'drugs.precautions',
                'drugs.warnings',
                'drugs.status',
                'drugs.created_at',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {


        return DB::transaction(function () use ($input) {

            $input['strength'] = serialize($input['strength']);
            $input['price'] = serialize($input['price']);
            if ($drug = Drug::create($input)) {

                    event(new DrugCreated($drug));

                    return $drug;
                }

            throw new GeneralException(__('exceptions.backend.drugs.create_error'));
        });
    }

    /**
     * @param \App\Models\Drug $drug
     * @param array $input
     */
    public function update(Drug $drug, array $input)
    {


        return DB::transaction(function () use ($drug, $input) {
            $input['strength'] = serialize($input['strength']);
            $input['price'] = serialize($input['price']);
            if ($drug->update($input)) {


                event(new DrugUpdated($drug));

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
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($input)
    {
        if (isset($input['featured_image']) && ! empty($input['featured_image'])) {
            $avatar = $input['featured_image'];
            $fileName = time().$avatar->getClientOriginalName();

            $this->storage->put($this->upload_path.$fileName, file_get_contents($avatar->getRealPath()));

            $input = array_merge($input, ['featured_image' => $fileName]);
        }

        return $input;
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
}
