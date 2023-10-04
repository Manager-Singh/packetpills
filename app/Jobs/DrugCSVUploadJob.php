<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Drug;
use App\Models\PreciptionType;
use App\Models\DrugAttribute;
use Str;

class DrugCSVUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        
    public $header;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        print_r($this->data);
        print_r($this->header);
        die;
        foreach ($this->data as $item) {
            $strength_unit = DrugAttribute::whereIn('name',[$item[4]])->where('type','strength_unit')->first();

            $strength_unit = DrugAttribute::whereIn('name',[$item[4]])->where('type','strength_unit')->first();
            $format = DrugAttribute::whereIn('name',[$item[5]])->where('type','format')->first();
            $pack_unit = DrugAttribute::whereIn('name',[$item[8]])->where('type','pack_unit')->first();
            $insurance_coverage = DrugAttribute::whereIn('name',[$item[14]])->where('type','insurance_coverage')->first();
            
            if($strength_unit){
                $item[4]=$strength_unit->id;
            }else{
                $new_strength_unit = new DrugAttribute();
                $new_strength_unit->name = $item[4];
                $new_strength_unit->type = 'strength_unit';
                $new_strength_unit->created_by = auth()->user()->id;
                if($new_strength_unit->save()){
                    $item[4]=$new_strength_unit->id;
                }

            }
            if($format){
                $item[5]=$format->id;
            }else{
                $new_format = new DrugAttribute();
                $new_format->name = $item[5];
                $new_format->type = 'format';
                $new_format->created_by = auth()->user()->id;
                if($new_format->save()){
                    $item[5]=$new_format->id;
                }

            }
            if($pack_unit){
                $item[8]=$pack_unit->id;
            }else{
                $new_pack_unit = new DrugAttribute();
                $new_pack_unit->name = $item[8];
                $new_pack_unit->type = 'pack_unit';
                $new_pack_unit->created_by = auth()->user()->id;
                if($new_pack_unit->save()){
                    $item[8]=$new_pack_unit->id;
                }

            }
            if($insurance_coverage){
                $item[14]=$insurance_coverage->id;
            }else{
                $new_insurance_coverage = new DrugAttribute();
                $new_insurance_coverage->name = $item[14];
                $new_insurance_coverage->type = 'insurance_coverage';
                $new_insurance_coverage->created_by = auth()->user()->id;
                if($new_insurance_coverage->save()){
                    $item[14]=$new_insurance_coverage->id;
                }

            }
            $preciption_types = PreciptionType::whereIn('preciption_type',[$item[20]])->first();
            if($preciption_types){
                $item[20]=$preciption_types->id;
            }else{
                $new_preciption_types = new PreciptionType();
                $new_preciption_types->preciption_type = $item[20];
                $new_preciption_types->slug = Str::slug($item[20]);
                $new_preciption_types->created_by = auth()->user()->id;
                if($new_preciption_types->save()){
                    $item[20]=$new_preciption_types->id;
                }

            }
            $item_csv_data = array_combine($this->header,$item);
            $item_csv_data['slug'] = Str::slug($item[0]);
            Drug::create($item_csv_data);
        }
    }
}
