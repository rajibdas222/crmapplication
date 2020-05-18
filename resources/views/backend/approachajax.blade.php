<table class="table table-bordered table-striped approach-table" id="approach-data">
    <thead id="thead" class="sticky-header">
    <tr>
        <th>No</th>
        <th>Export CSV</th>
        <th>User ID</th>
        <th>Class</th>
        <th>J_Code</th>
        <th>Responsible</th>
        <th>wholesaler_kana</th>
        <th>wholesaler_name</th>
        <th>charges</th>
        <th>invoice_name</th>
        <th>department</th>
        <th>tel</th>
        <th>zip</th>
        <th>address</th>
        <th>address2</th>
        <th>basic_rate</th>
        <th>line_rate</th>
        <th>super_code</th>
        <th>super_name</th>
        <th>lease_class</th>
        <th>system</th>
        <th>maturity_date</th>
        <th>contract_date</th>
        <th>cancel_date</th>
        <th>period</th>
        <th>contract_renewal</th>
        <th>cancel_reason</th>
        <th>cancel_reception_date</th>
        <th>management_nb</th>
        <th>sales_nb</th>
        <th>support_nb</th>
        <th>customer_code</th>
        <th>month_payment</th>
        <th>month_sales</th>
        <th>month_balance</th>
        <th>automatic_transfer</th>
        <th>created</th>
        <th>modified</th>
        <th class="text-center">action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($approaches as $i=>$app_data)
        <tr class="text-center">
            <td>{{$app_data->id}}</td>
            <td>
                <input type="checkbox" row_id="{{$app_data->id}}" class="check-data-row" onclick="">
            </td>
            <td>{{$app_data->userID}}</td>
            <td>{{$app_data->class_data}}</td>
            <td>{{$app_data->j_code}}</td>
            <td>{{$app_data->responsible}}</td>
            <td>{{$app_data->wholesaler_kana}}</td>
            <td>{{$app_data->wholesaler_name}}</td>
            <td>{{$app_data->charges}}</td>
            <td>{{$app_data->invoice_name}}</td>
            <td>{{$app_data->department}}</td>
            <td>{{$app_data->tel}}</td>
            <td>{{$app_data->zip_code}}</td>
            <td>{{$app_data->address}}</td>
            <td>{{$app_data->address2}}</td>
            <td>{{$app_data->basic_rate}}</td>
            <td>{{$app_data->line_rate}}</td>
            <td>{{$app_data->super_code}}</td>
            <td>{{$app_data->super_name}}</td>
            <td>{{$app_data->lease_class}}</td>
            <td>{{$app_data->system}}</td>
            <td>{{$app_data->maturity_date}}</td>
            <td>{{$app_data->contract_date}}</td>
            <td>{{$app_data->cancelle_date}}</td>
            <td>{{$app_data->period_data}}</td>
            <td>{{$app_data->contract_renewal}}</td>
            <td>{{$app_data->cancel_reason}}</td>
            <td>{{$app_data->cancelle_reception_date}}</td>
            <td>{{$app_data->management_nb}}</td>
            <td>{{$app_data->sales_nb}}</td>
            <td>{{$app_data->support_nb}}</td>
            <td>{{$app_data->customer_code}}</td>
            <td>{{$app_data->month_payment}}</td>
            <td>{{$app_data->month_sales}}</td>
            <td>{{$app_data->month_balance}}</td>
            <td>{{$app_data->automatic_transfer}}</td>
            <td>{{$app_data->created}}</td>
            <td>{{$app_data->modified}}</td>


            <td class="d-flex justify-content-center">
                <div class="btn-group" role="group">
                    <input type="hidden" class="row_id" value="{{$app_data->id}}" name="row_id">
                    <a data-id="{{$app_data->id}}" class="approach_edit btn btn-primary btn-md">
                                        <span class="fa fa-pen-square" aria-hidden="true" data-toggle="tooltip"
                                              data-placement="top" title="Edit"></span>
                    </a>

                    <a href="#" class="btn btn-warning btn-md" data-toggle="modal"
                       data-target="#approachModal">
                                        <span class="fa fa-eye" aria-hidden="true" data-toggle="tooltip"
                                              data-placement="top" title="Show"></span>
                    </a>

                    <form class="form-inline" method="post"
                          action="{{route('approach-delete',$app_data->id)}}"
                          onsubmit="return confirm('Are you sure to delete the Data?')">
                        {{ csrf_field() }}
                        <input type="hidden" name="__method" value="delete">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>


                </div>

            </td>


        </tr>

    @endforeach

    </tbody>
</table>

<div id="pagination" class="mx-auto justify-content-center text-center">
    {{ $approaches->links()}}
</div>