<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Approach;


class ApproachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = 'Dashboard';
        $title = "Approach page";
        $q = $request->input('query');
        $j_code = $request->j_code;
        $wholesaler_name = $request->wholesaler_name;

        $query = DB::table('approaches');
        if ($j_code != '') {
            $query = $query->where('j_code', 'like', '%' . $j_code . $q . '%');
        }
        if ($wholesaler_name != '') {
            $query = $query->orWhere('wholesaler_name', 'like', '%' . $wholesaler_name . $q . '%');
        }

        $approaches = $query->paginate(15);

        if ($request->ajax()) {
            return view('backend.approachajax', compact('approaches'));
        }
        return view('backend.home', compact('approaches','active','active','title'));


        //$title = "Approach page";

        //$approach = DB::table('approaches')->paginate(15);
        //echo '<pre>';
        //print_r($approach);
        //die();
        //return view('backend.home', compact('title','approach', 'active'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'class_data' => 'required',
            'j_code' => 'required',
            'wholesaler_kana' => 'required',

        ]);

        $userID = $request->userID;
        $class_data = $request->class_data;
        $j_code = $request->j_code;
        $responsible = $request->responsible;
        $wholesaler_kana = $request->wholesaler_kana;
        $wholesaler_name = $request->wholesaler_name;
        $charges = $request->charges;
        $invoice_name = $request->invoice_name;
        $department = $request->department;
        $tel = $request->tel;
        $fax = $request->fax;
        $zip_code = $request->zip_code;
        $address = $request->address;
        $address2 = $request->address2;
        $basic_rate = $request->basic_rate;
        $line_rate = $request->line_rate;
        $super_code = $request->super_code;
        $super_name = $request->super_name;
        $lease_class = $request->lease_class;
        $id_3 = $request->id_3;
        $system = $request->system;
        $maturity_date = $request->maturity_date;
        $sales_staff = $request->sales_staff;
        $contract_date = $request->contract_date;
        $cancel_date = $request->cancel_date;
        $period_data = $request->period_data;
        $contract_renewal = $request->contract_renewal;
        $cancel_reason = $request->cancel_reason;
        $management_nb = $request->management_nb;
        $sales_nb = $request->sales_nb;
        $support_nb = $request->support_nb;
        $customer_code = $request->customer_code;
        $month_payment = $request->month_payment;
        $month_sales = $request->month_sales;
        $month_balance = $request->month_balance;
        $automatic_transfer = $request->automatic_transfer;
        $zennginn = $request->zennginn;
        $pit = $request->pit;
        $kadou = $request->kadou;
        $torihikisaki_itirann = $request->torihikisaki_itirann;


        $insert_array = array(

            'userID' => $userID,
            'class_data' => $class_data,
            'j_code' => $j_code,
            'responsible' => $responsible,
            'wholesaler_kana' => $wholesaler_kana,
            'wholesaler_name' => $wholesaler_name,
            'charges' => $charges,
            'invoice_name' => $invoice_name,
            'department' => $department,
            'tel' => $tel,
            'fax' => $fax,
            'zip_code' => $zip_code,
            'address' => $address,
            'address2' => $address2,
            'basic_rate' => $basic_rate,
            'line_rate' => $line_rate,
            'super_code' => $super_code,
            'super_name' => $super_name,
            'lease_class' => $lease_class,
            'id_3' => $id_3,
            'system' => $system,
            'maturity_date' => $maturity_date,
            'sales_staff' => $sales_staff,
            'contract_date' => $contract_date,
            'cancel_date' => $cancel_date,
            'period_data' => $period_data,
            'contract_renewal' => $contract_renewal,
            'cancel_reason' => $cancel_reason,
            'management_nb' => $management_nb,
            'sales_nb' => $sales_nb,
            'support_nb' => $support_nb,
            'customer_code' => $customer_code,
            'month_payment' => $month_payment,
            'month_sales' => $month_sales,
            'month_balance' => $month_balance,
            'automatic_transfer' => $automatic_transfer,
            'zennginn' => $zennginn,
            'pit' => $pit,
            'kadou' => $kadou,
            'torihikisaki_itirann' => $torihikisaki_itirann,

        );



        if ($request->id){
            Approach::update($insert_array, $request->id);
            return response()->json(['success' => true, 'result' => 'Data updated successfully', 'approach' => $insert_array]);
        }else{

            Approach::insert($insert_array);
            return response()->json(['success' => true, 'result' => 'Data created successfully', 'approach' => $insert_array]);
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Approach $approach
     * @return \Illuminate\Http\Response
     */
    public function show(Approach $approach)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Approach $approach
     * @return \Illuminate\Http\Response
     */
    public function edit(Approach $approach, $id)
    {
        $approach = Approach::find($id);
        return json_encode($approach);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Approach $approach
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            //print_r($request->userID());
            //exit();
        $request->validate([
            'id' => 'required',
            'userID' => 'required',
            'class_data' => 'required',
            'j_code' => 'required',
            'responsible' => 'required',
            'wholesaler_kana' => 'required',
            'wholesaler_name' => 'required',
            'charges' => 'required',
            'invoice_name' => 'required',
            'department' => 'required',
            'tel' => 'required',
            'fax' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'address2' => 'required',
            'basic_rate' => 'required',
            'line_rate' => 'required',
            'super_code' => 'required',
            'super_name' => 'required',
            'lease_class' => 'required',
            'id_3' => 'required',
            'system' => 'required',
            'maturity_date' => 'required',
            'sales_staff' => 'required',
            'contract_date' => 'required',
            'cancel_date'=>'required',
            'period' => 'required',
            'contract_renewal' => 'required',
            'cancel_reason'=>'required',
            'cancel_reception_date'=>'required',
            'management_nb' => 'required',
            'sales_nb' => 'required',
            'support_nb' => 'required',
            'customer_code' => 'required',
            'month_payment' => 'required',
            'month_sales' => 'required',
            'month_balance' => 'required',
            'automatic_transfer' =>'required',
            'zennginn' => 'required',
            'pit' => 'required',
            'kadou' => 'required',
            'torihikisaki_itirann' =>'required',
        ]);

        $userID = $request->userID;
        $id = $request->id;
        $class_data = $request->class_data;
        $j_code = $request->j_code;
        $responsible = $request->responsible;
        $wholesaler_kana = $request->wholesaler_kana;
        $wholesaler_name = $request->wholesaler_name;
        $charges = $request->charges;
        $invoice_name = $request->invoice_name;
        $department = $request->department;
        $tel = $request->tel;
        $fax = $request->fax;
        $zip_code = $request->zip_code;
        $address = $request->address;
        $address2 = $request->address2;
        $basic_rate = $request->basic_rate;
        $line_rate = $request->line_rate;
        $super_code = $request->super_code;
        $super_name = $request->super_name;
        $lease_class = $request->lease_class;
        $id_3 = $request->id_3;
        $system = $request->system;
        $maturity_date = $request->maturity_date;
        $sales_staff = $request->sales_staff;
        $contract_date = $request->contract_date;
        $cancel_date = $request->cancel_date;
        $period = $request->period;
        $contract_renewal = $request->contract_renewal;
        $cancel_reason = $request->cancel_reason;
        $cancel_reception_date = $request->cancel_reason;
        $management_nb = $request->management_nb;
        $sales_nb = $request->sales_nb;
        $support_nb = $request->support_nb;
        $customer_code = $request->customer_code;
        $month_payment = $request->month_payment;
        $month_sales = $request->month_sales;
        $month_balance = $request->month_balance;
        $automatic_transfer = $request->automatic_transfer;
        $zennginn = $request->zennginn;
        $pit = $request->pit;
        $kadou = $request->kadou;
        $torihikisaki_itirann = $request->torihikisaki_itirann;


        $update_array = array(
            'id'=> $id,
            'userID' => $userID,
            'class_data' => $class_data,
            'j_code' => $j_code,
            'responsible' => $responsible,
            'wholesaler_kana' => $wholesaler_kana,
            'wholesaler_name' => $wholesaler_name,
            'charges' => $charges,
            'invoice_name' => $invoice_name,
            'department' => $department,
            'tel' => $tel,
            'fax' => $fax,
            'zip_code' => $zip_code,
            'address' => $address,
            'address2' => $address2,
            'basic_rate' => $basic_rate,
            'line_rate' => $line_rate,
            'super_code' => $super_code,
            'super_name' => $super_name,
            'lease_class' => $lease_class,
            'id_3' => $id_3,
            'system' => $system,
            'maturity_date' => $maturity_date,
            'sales_staff' => $sales_staff,
            'contract_date' => $contract_date,
            'cancel_date' => $cancel_date,
            'period' => $period,
            'contract_renewal' => $contract_renewal,
            'cancel_reason' => $cancel_reason,
            'cancel_reception_date' => $cancel_reception_date,
            'management_nb' => $management_nb,
            'sales_nb' => $sales_nb,
            'support_nb' => $support_nb,
            'customer_code' => $customer_code,
            'month_payment' => $month_payment,
            'month_sales' => $month_sales,
            'month_balance' => $month_balance,
            'automatic_transfer' => $automatic_transfer,
            'zennginn' => $zennginn,
            'pit' => $pit,
            'kadou' => $kadou,
            'torihikisaki_itirann' => $torihikisaki_itirann,

        );
//        echo json_encode($update_array);
//        exit();
        Approach::update($update_array, $id);
        return response()->json(['success' => true, 'result' => 'Data updated successfully', 'approach' => $update_array]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Approach $approach
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Approach::where('id', $id)->delete();
        return redirect('home')->with('success', 'Data deleted successfully');
    }



    public function jqueryLoadMore_normal(Request $request){

        $q = $request->input('query');
        $j_code = $request->j_code;
        $wholesaler_name = $request->wholesaler_name;

        $query = DB::table('approaches');
        if ($j_code != '') {
            $query = $query->where('j_code', 'like', '%' . $j_code .$q. '%');
        }
        if ($wholesaler_name != '') {
            $query = $query->orWhere('wholesaler_name', 'like', '%' . $wholesaler_name . $q . '%');
        }

        //$approaches = $query->paginate(15);
        $query = $query->paginate(15);
        $getData = json_encode($query);
        $getData = json_Decode($getData);
        $items = $getData->data;
        $totals = $getData->total;
        return $result = response()->json(['pagi' => (string)$query->links(),'items' => $items,'total'=>$totals]);
    }

}
