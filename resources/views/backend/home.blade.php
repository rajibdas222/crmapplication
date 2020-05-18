@extends('backend.layouts.master')
@section('title')
    <title>{{__('messages.dashboard_text')}}</title>
@endsection


@section('content')

    <div class="main-content-container container-fluid px-4 pt-2">

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox2">
                    <div class="statistic-box">
                        <div class="header-icon">
                            <i class="fas fa-tachometer-alt fa-3x"></i>
                        </div>
                        <h4 class="text-white waves-effect">{{$active}}</h4>
                        <div class="counter-number pull-right">
                            <small>JACOS CRM Admin Dashboard</small>
                            <span class="slight"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox1">
                    <div class="statistic-box">
                        <i class="fa fa-user-plus fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">11</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                        </div>
                        <h3> Active Client</h3>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox3">
                    <div class="statistic-box">
                        <i class="fas fa-money-bill-alt fa-3x"></i>
                        <div class="counter-number pull-right">
                            <i class="ti ti-money"></i><span class="count-number">965</span>
                            <span class="slight"><i class="fas fa-money-check-alt"></i>
                              </span>
                        </div>
                        <h3>Total Expenses</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div id="cardbox4">
                    <div class="statistic-box">
                        <i class="fas fa-file-image fa-3x"></i>
                        <div class="counter-number pull-right">
                            <span class="count-number">11</span>
                            <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                              </span>
                        </div>
                        <h3>Running Projects</h3>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif


        <div class="card card-default mb-2 card-wrapper">
            <div id="crm-btn-top " class="top-btn">
                <div class="icon-name row">
                    <div class="col-md-4 col-sm-6">
                        <button class="btn btn-md btn-info btn-xl" id="approachModalData" data-toggle="modal"
                                data-target="#approachModal">
                            <i class="fas fa-plus mr-1"></i>Create approach
                        </button>

                        <a class="btn btn-warning btn-md csv-export-data btn-xl" href="#"><span
                                    class="fa fa-file-excel mr-1"></span>CSV Export
                        </a>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <form class="" action="{{url('home/importcsv')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input class="btn btn-info btn-md csv-up-btn" type='file' name='csvfile'>
                                <button type="submit" name="submit" class="btn btn-outline-secondary btn-md btn-xl"
                                        value='Upload CSV'>Upload CSV
                                </button>
                            </form>
                        </div>
                    </div>


                </div>

                <form method="get" action="home/search" id="searching_form" class="mt-2">
                    <div class="input-group mb-2 border rounded-pill p-1">
                        <div class="input-group-prepend border-0">
                            <button id="button-addon4" type="button" class="btn btn-link text-info"><i
                                        class="fa fa-search"></i></button>
                        </div>
                        <input type="search" placeholder="SEARCH JAN" aria-describedby="button-addon4"
                               class="form-control bg-none border-0" id="searchData" name="searchData">
                    </div>
                </form>

            </div>


        </div>

        <div class="row">

            <div class="panel panel-info approach-table-wrapper" id="tag_container">
                @include('backend.approachajax')
            </div>


        </div>


        <!--- New  Modal Window---->

        <div class="modal fade approachModalCls" id="approachModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg approach-modal" role="document" aria-labelledby="approachModalLabel"
                 aria-hidden="true">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Data</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>


                    <form id="approachForm" role="form">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id" value="">
                            <div class="row">
                                <div class="col-md-6 approch-input-data-left">

                                    <div class="form-group">
                                        <label for="User_Id" class="col-form-label">User Id</label>
                                        <input type="number" class="form-control" id="user_id" name="user_id">
                                        <span class="text-danger"><strong id="user_id_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Class" class="col-form-label">Class</label>
                                        <input type="text" class="form-control" id="class_data" name="class_data">
                                        <span class="text-danger"><strong id="class_name_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="j_code" class="col-form-label">j_code</label>
                                        <input type="text" class="form-control" id="j_code" name="j_code">
                                        <span class="text-danger"><strong id="j_code_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="responsible" class="col-form-label">Responsible</label>
                                        <input type="text" class="form-control" id="responsible" name="responsible">
                                        <span class="text-danger"><strong id="responsible_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="wholesaler_kana" class="col-form-label">Wholesaler_kana</label>
                                        <input type="text" class="form-control" id="wholesaler_kana"
                                               name="wholesaler_kana">
                                        <span class="text-danger"><strong id="wholesaler_kana_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="wholesaler_name" class="col-form-label">Wholesaler_name</label>
                                        <input type="text" class="form-control" id="wholesaler_name"
                                               name="wholesaler_name">
                                        <span class="text-danger"><strong id="wholesaler_name_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="charges" class="col-form-label">Charges</label>
                                        <input type="text" class="form-control" id="charges" name="charges">
                                        <span class="text-danger"><strong id="charges_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="invoice_name" class="col-form-label">Invoice_Name</label>
                                        <input type="text" class="form-control" id="invoice_name" name="invoice_name">
                                        <span class="text-danger"><strong id="invoice_name_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="department" class="col-form-label">Department</label>
                                        <input type="text" class="form-control" id="department" name="department">
                                        <span class="text-danger"><strong id="department_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="tel" class="col-form-label">Tel</label>
                                        <input type="tel" class="form-control" id="tel" name="tel">
                                        <span class="text-danger"><strong id="tel_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="fax" class="col-form-label">Fax</label>
                                        <input type="text" class="form-control" id="fax" name="fax">
                                        <span class="text-danger"><strong id="fax_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="zip_code" class="col-form-label">Zip code</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode">
                                        <span class="text-danger"><strong id="zipcode_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                        <span class="text-danger"><strong id="address_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="address2" class="col-form-label">Address2</label>
                                        <input type="text" class="form-control" id="address2" name="address2">
                                        <span class="text-danger"><strong id="address2_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="basic_rate" class="col-form-label">Basic Rate</label>
                                        <input type="text" class="form-control" id="basic_rate" name="basic_rate">
                                        <span class="text-danger"><strong id="basic_rate_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="line_rate" class="col-form-label">Line Rate</label>
                                        <input type="text" class="form-control" id="line_rate" name="line_rate">
                                        <span class="text-danger"><strong id="line_rate_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="super_code" class="col-form-label">Super Code</label>
                                        <input type="text" class="form-control" id="super_code" name="super_code">
                                        <span class="text-danger"><strong id="super_code_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="super_name" class="col-form-label">Super Name</label>
                                        <input type="text" class="form-control" id="super_name" name="super_name">
                                        <span class="text-danger"><strong id="super_name_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="lease_class" class="col-form-label">Lease Class</label>
                                        <input type="text" class="form-control" id="lease_class" name="lease_class">
                                        <span class="text-danger"><strong id="lease_class_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="id3" class="col-form-label">ID 3</label>
                                        <input type="text" class="form-control" id="id3" name="id_3">
                                        <span class="text-danger"><strong id="id3_error"></strong></span>
                                    </div>


                                </div>
                                <div class="col-md-6 approch-input-data-right">

                                    <div class="form-group">
                                        <label for="system" class="col-form-label">System</label>
                                        <input type="text" class="form-control" id="system" name="system">
                                        <span class="text-danger"><strong id="system_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="maturity_date" class="col-form-label">Maturity_Date</label>
                                        <input type="date" class="form-control" id="maturity_date" name="maturity_date">
                                        <span class="text-danger"><strong id="maturity_date_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="sales_staff" class="col-form-label">Sales_Staff</label>
                                        <input type="text" class="form-control" id="sales_staff" name="sales_staff">
                                        <span class="text-danger"><strong id="sales_staff_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="contract_date" class="col-form-label">Contract_Date</label>
                                        <input type="date" class="form-control" id="contract_date" name="contract_date">
                                        <span class="text-danger"><strong id="contract_date_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cancel_date" class="col-form-label">Cancel Date</label>
                                        <input type="date" class="form-control" id="cancel_date" name="cancel_date">
                                        <span class="text-danger"><strong id="cancel_date_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="period" class="col-form-label">Period</label>
                                        <input type="text" class="form-control" id="period" name="period_data">
                                        <span class="text-danger"><strong id=period_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="contract_renewal" class="col-form-label">Contract Renewal</label>
                                        <input type="text" class="form-control" id="contract_renewal"
                                               name="contract_renewal">
                                        <span class="text-danger"><strong id="contract_renewal_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="cancel_reason" class="col-form-label">Cancel Reason</label>
                                        <input type="text" class="form-control" id="cancel_reason" name="cancel_reason">
                                        <span class="text-danger"><strong id="cancel_reason_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="cancel_reception_date" class="col-form-label">Cancel Reception
                                            Date</label>
                                        <input type="date" class="form-control" id="cancel_reception_date"
                                               name="cancel_reception_date">
                                        <span class="text-danger"><strong
                                                    id="cancel_reception_date_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="management_nb" class="col-form-label">Management_nb</label>
                                        <input type="text" class="form-control" id="management_nb" name="management_nb">
                                        <span class="text-danger"><strong id="management_nb_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="sales_nb" class="col-form-label">Sales_nb</label>
                                        <input type="text" class="form-control" id="sales_nb" name="sales_nb">
                                        <span class="text-danger"><strong id="sales_nb_error"></strong></span>
                                    </div>


                                    <div class="form-group">
                                        <label for="customer_code" class="col-form-label">Customer Code</label>
                                        <input type="text" class="form-control" id="customer_code" name="customer_code">
                                        <span class="text-danger"><strong id="customer_code_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="month_payment" class="col-form-label">Month Payment</label>
                                        <input type="text" class="form-control" id="month_payment" name="month_payment">
                                        <span class="text-danger"><strong id="month_payment_error"></strong></span>
                                    </div>


                                    <div class="form-group">
                                        <label for="month_sales" class="col-form-label">Month Sales</label>
                                        <input type="text" class="form-control" id="month_sales" name="month_sales">
                                        <span class="text-danger"><strong id="month_sales_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="month_balance" class="col-form-label">Month Balance</label>
                                        <input type="text" class="form-control" id="month_balance" name="month_balance">
                                        <span class="text-danger"><strong id="month_balance_error"></strong></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="automatic_transfer" class="col-form-label">Automatic
                                            Transfer</label>
                                        <input type="text" class="form-control" id="automatic_transfer"
                                               name="automatic_transfer">
                                        <span class="text-danger"><strong id="automatic_transfer_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="zennginn" class="col-form-label">Zennginn</label>
                                        <input type="text" class="form-control" id="zennginn" name="zennginn">
                                        <span class="text-danger"><strong id="zennginn_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pit" class="col-form-label">Pit</label>
                                        <input type="text" class="form-control" id="pit" name="pit">
                                        <span class="text-danger"><strong id="pit_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="kadou" class="col-form-label">Kadou</label>
                                        <input type="text" class="form-control" id="kadou" name="kadou">
                                        <span class="text-danger"><strong id="kadou_error"></strong></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="torihikisaki_itirann" class="col-form-label">Torihikisaki
                                            Itirann</label>
                                        <input type="text" class="form-control" id="torihikisaki_itirann"
                                               name="torihikisaki_itirann">
                                        <span class="text-danger"><strong
                                                    id="torihikisaki_itirann_error"></strong></span>
                                    </div>


                                </div>
                            </div>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary btn-lg" id="submitForm">Save</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>




@endsection

