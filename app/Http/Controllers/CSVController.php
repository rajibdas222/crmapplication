<?php

namespace App\Http\Controllers;

use App\Exports\ApproachExport;
use Illuminate\Http\Request;
use App\Approach;
use DB;

class CSVController extends Controller
{

    public function export_selected($ids)
    {
        $data = explode(",", $ids);
        if (!empty($data)) {
            return (new ApproachExport)->forIds($data)->download('approaches_data.csv');
        }
    }


    public function importcsv(Request $request)
    {
        //return $request->all();
        $file = $request->file('csvfile');
        $file_name = $file->getClientOriginalName();
        // File Name change
        $fileName = time().'_'.$file_name;
        $file_temp_path = public_path('csv');
        $file->move($file_temp_path, $fileName);
        $baseUrl = public_path('/csv/').$fileName;
        $new_array = array();
        $csv_datas = $this->csvReader($baseUrl);

        foreach ($csv_datas as $key =>$csv_data){
            $temp_array['userID']=$csv_data[1];
            $temp_array['class_data']=$csv_data[2];
            $temp_array['j_code']=$csv_data[3];
            $temp_array['responsible']=$csv_data[4];
            $temp_array['wholesaler_kana']=$csv_data[5];
            $temp_array['wholesaler_name']=$csv_data[6];
            $temp_array['charges']=$csv_data[7];
            $temp_array['invoice_name']=$csv_data[8];
            $temp_array['department']=$csv_data[9];
            $temp_array['tel']=$csv_data[10];
            $temp_array['fax']=$csv_data[11];
            $temp_array['zip_code']=$csv_data[12];
            $temp_array['address']=$csv_data[13];
            $temp_array['address2']=$csv_data[14];
            $temp_array['basic_rate']=$csv_data[15];
            $temp_array['line_rate']=$csv_data[16];
            $temp_array['super_code']=$csv_data[17];
            $temp_array['super_name']=$csv_data[18];
            $temp_array['lease_class']=$csv_data[19];
            $temp_array['id_3']=$csv_data[20];
            $temp_array['system']=$csv_data[21];
            $temp_array['maturity_date']=$csv_data[22];
            $temp_array['sales_staff']=$csv_data[23];
            $temp_array['contract_date']=$csv_data[24];
            $temp_array['cancelle_date']=$csv_data[25];
            $temp_array['period_data']=$csv_data[26];
            $temp_array['contract_renewal']=$csv_data[27];
            $temp_array['cancelle_reason']=$csv_data[28];
            $temp_array['cancelle_reception_date']=$csv_data[29];
            $temp_array['management_nb']=$csv_data[30];
            $temp_array['sales_nb']=$csv_data[31];
            $temp_array['support_nb']=$csv_data[32];
            $temp_array['customer_code']=$csv_data[33];
            $temp_array['month_payment']=$csv_data[34];
            $temp_array['month_sales']=$csv_data[35];
            $temp_array['month_balance']=$csv_data[36];
            $temp_array['automatic_transfer']=$csv_data[37];
            $temp_array['zennginn']=$csv_data[38];
            $temp_array['pit']=$csv_data[39];
            $temp_array['kadou']=$csv_data[40];
            $temp_array['torihikisaki_itirann']=$csv_data[41];
            $temp_array['created']=date('Y-m-d H:i:s', strtotime($csv_data[42]));
            $temp_array['modified']=date('Y-m-d H:i:s', strtotime($csv_data[43]));


            $new_array[]=$temp_array;


        }
        //return $new_array;
        Approach::insert($new_array);
        return redirect('home')->with('success', 'CSV Import successfully');


    }

    public function csvReader($baseUrl)
    {
        $data = array_map('str_getcsv', file($baseUrl));
        $csv_data = array_slice($data, 0);
        $rowData = $this->convert_from_sjis_to_utf8_recursively($csv_data);
        return $rowData;
    }

    public static function convert_from_sjis_to_utf8_recursively($dat_ch)
    {
        if (is_string($dat_ch)) {
            return mb_convert_encoding($dat_ch, "UTF-8", "sjis-win");
        } elseif (is_array($dat_ch)) {
            $ret = [];
            foreach ($dat_ch as $i => $d) {
                $ret[$i] = self::convert_from_sjis_to_utf8_recursively($d);
            }
            return $ret;
        } elseif (is_object($dat_ch)) {
            foreach ($dat_ch as $i => $d) {
                $dat_ch->$i = self::convert_from_sjis_to_utf8_recursively($d);
            }
            return $dat_ch;
        } else {
            return $dat_ch;
        }
    }

}
