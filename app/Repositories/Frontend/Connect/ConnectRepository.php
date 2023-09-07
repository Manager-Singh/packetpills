<?php

namespace App\Repositories\Frontend\Connect;

use App\Exceptions\GeneralException;
use App\Models\EnterpriseConnect;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
/**
 * Class PrescriptionRepository.
 */
class ConnectRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = EnterpriseConnect::class;


    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function create(array $data)
    {

        $connect = self::MODEL;
        $connect = new $connect();
        $connect->full_name = $data['full_name'];
        $connect->company = $data['company'];
        $connect->email = $data['email'];
        $connect->job_title = $data['job_title'];
        $connect->phone_no = $data['phone_no'];
        if($connect->save()){
            return $connect;

        }

        throw new GeneralException(__('Data not save'));
                   
    } 
}
