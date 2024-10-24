@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }
</style>
@endsection

@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Consignment & Job Creation</h4>
    </div>
    <div class="col-md-7 align-self-center text-end">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Consignment & Job Creation
                </li>
            </ol>
        </div>
    </div>
</div>

<form method="post" action="{{URL::to('admin/consignments')}}/{{Crypt::encryptString($model->id)}}" >
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
          <section class="card">
              <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">Jobs With Consignment information</h4>
              </header>
              <div class="card-body">
                 <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Job Number (Auto)</label>
                            <input readonly type="text" value="{{$model->job_number_prefix}}" name="job_number" 
                            class="form-control" placeholder="Job Number">
                            @if($errors->has('job_number'))
                             <p class="text-danger" >{{ $errors->first('job_number') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Consignee (Company Name)</label>
                            <select name="customer_id" class="form-control" >
                                <option value="">Select Consignee</option>
                                @foreach ($customers as $item)
                                    <option @if($item->id == $model->customer_id) selected @endif value="{{$item->id}}">{{$item->company_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('customer_id'))
                             <p class="text-danger" >{{ $errors->first('customer_id') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> BL/AWB No </label>
                            <input value="{{$model->blawbno}}" 
                            name="blawbno" class="form-control" placeholder="BL/AWB No ">
                            @if($errors->has('blawbno'))
                             <p class="text-danger" >{{ $errors->first('blawbno') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> LC/BT/IT No </label>
                            <input value="{{$model->lcbtitno}}" name="lcbtitno" 
                             class="form-control" placeholder="LC/BT/IT No">
                            @if($errors->has('lcbtitno'))
                             <p class="text-danger" >{{ $errors->first('lcbtitno') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label"> Description </label>
                            <input value="{{$model->description}}" name="description" 
                             class="form-control" placeholder="Description">
                            @if($errors->has('description'))
                             <p class="text-danger" >{{ $errors->first('description') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> Invoice Value </label>
                            <input value="{{$model->invoice_value}}" name="invoice_value" 
                             class="form-control" placeholder="Invoice Value">
                            @if($errors->has('invoice_value'))
                             <p class="text-danger" >{{ $errors->first('invoice_value') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Select Invoice Currency</label>
                            <select class="form-control" name="currency">
                                @foreach ($currencies as $cr)
                                <option @if($model->currency == $cr['code']) selected @endif value="{{$cr['code']}}">{{$cr['code']}}</option>
                               @endforeach
                            </select>
                            @if($errors->has('currency'))
                             <p class="text-danger" >{{ $errors->first('currency') }}</p>
                            @endif 
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"> Machine Number </label>
                            <input value="{{$model->machine_number}}" name="machine_number" 
                             class="form-control" placeholder="Machine Number">
                            @if($errors->has('machine_number'))
                             <p class="text-danger" >{{ $errors->first('machine_number') }}</p>
                            @endif 
                        </div>
                    </div>  

                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div> 
            </div>
        </section>
    </div>


    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">Consignment information</h4>
            </header>
            <div class="card-body">

               <div class="row">

                  <div class="col-md-3">
                      <div class="form-group">
                          <label class="form-label">Job Number</label>
                          <input readonly value="{{$model->job_number_prefix}}"
                          class="form-control">
                      </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Your REF</label>
                        <input required value="{{$model->your_ref}}" name="your_ref" 
                        class="form-control" placeholder="Your REF">
                        @if($errors->has('your_ref'))
                         <p class="text-danger" >{{ $errors->first('your_ref') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port</label>
                        <input required value="{{$model->port}}" name="port" 
                        class="form-control" placeholder="Port">
                        @if($errors->has('port'))
                         <p class="text-danger" >{{ $errors->first('port') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">EIF/FI NO</label>
                        <input required value="{{$model->eiffino}}" name="eiffino" 
                        class="form-control" placeholder="EIF/FI NO">
                        @if($errors->has('eiffino'))
                         <p class="text-danger" >{{ $errors->first('eiffino') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Import/Exporter Messers</label>
                        <input required value="{{$model->import_exporter_messers}}" name="import_exporter_messers" 
                        class="form-control" placeholder="Import/Exporter Messers">
                        @if($errors->has('import_exporter_messers'))
                         <p class="text-danger" >{{ $errors->first('import_exporter_messers') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Consignee by / To</label>
                        <input required value="{{$model->consignee_by_to}}" name="consignee_by_to" 
                        class="form-control" placeholder="Consignee by / To">
                        @if($errors->has('consignee_by_to'))
                         <p class="text-danger" >{{ $errors->first('consignee_by_to') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Invoice Value</label>
                        <input readonly value="{{$model->invoice_value}}" 
                        class="form-control" placeholder="Invoice Value">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Invoice Currency</label>
                        <input readonly value="{{$model->currency}}" 
                        class="form-control" placeholder="Invoice Currency">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Freight</label>
                        <input required value="{{$model->freight}}" name="freight" 
                        class="form-control" placeholder="Freight">
                        @if($errors->has('freight'))
                         <p class="text-danger" >{{ $errors->first('freight') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Ins Rs</label>
                        <input required value="{{$model->ins_rs}}" name="ins_rs" 
                        class="form-control" placeholder="Ins Rs">
                        @if($errors->has('ins_rs'))
                         <p class="text-danger" >{{ $errors->first('ins_rs') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">US $</label>
                        <input required value="{{$model->us}}" name="us" 
                        class="form-control" placeholder="US $">
                        @if($errors->has('us'))
                         <p class="text-danger" >{{ $errors->first('us') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">LC no</label>
                        <input required  value="{{$model->lc_no}}" name="lc_no" 
                        class="form-control" placeholder="LC no">
                        @if($errors->has('lc_no'))
                         <p class="text-danger" >{{ $errors->first('lc_no') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Vessel</label>
                        <input required value="{{$model->vessel}}" name="vessel" 
                        class="form-control" placeholder="Vessel">
                        @if($errors->has('vessel'))
                         <p class="text-danger" >{{ $errors->first('vessel') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">IGM No</label>
                        <input required value="{{$model->igmno}}" name="igmno" 
                        class="form-control" placeholder="IGM No">
                        @if($errors->has('igmno'))
                         <p class="text-danger" >{{ $errors->first('igmno') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">BL/AWB No</label>
                        <input readonly value="{{$model->blawbno}}"
                        class="form-control" placeholder="BL/AWB No">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Port Of Shippment</label>
                        <input required value="{{$model->port_of_shippment}}" name="port_of_shippment" 
                        class="form-control" placeholder="Port Of Shippment">
                        @if($errors->has('port_of_shippment'))
                         <p class="text-danger" >{{ $errors->first('port_of_shippment') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Country Origion</label>
                        <input required value="{{$model->country_origion}}" name="country_origion" 
                        class="form-control" placeholder="Country Origion">
                        @if($errors->has('country_origion'))
                         <p class="text-danger" >{{ $errors->first('country_origion') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Rate Of Exchange</label>
                        <input required type="number"  value="{{$model->rate_of_exchange}}" name="rate_of_exchange" 
                        class="form-control" placeholder="Rate Of Exchange">
                        @if($errors->has('rate_of_exchange'))
                         <p class="text-danger" >{{ $errors->first('rate_of_exchange') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Master Agent</label>
                        <input required  value="{{$model->master_agent}}" name="master_agent" 
                        class="form-control" placeholder="Master Agent">
                        @if($errors->has('master_agent'))
                         <p class="text-danger" >{{ $errors->first('master_agent') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Due Date</label>
                        <input required type="date"  value="{{ \Carbon\Carbon::parse($model->due_date)->format('Y-m-d') }}" name="due_date" 
                        class="form-control" placeholder="Due Date">
                        @if($errors->has('due_date'))
                         <p class="text-danger" >{{ $errors->first('due_date') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Gross</label>
                        <input required type="number"  value="{{$model->gross}}" name="gross" 
                        class="form-control" placeholder="Gross">
                        @if($errors->has('gross'))
                         <p class="text-danger" >{{ $errors->first('gross') }}</p>
                        @endif 
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Nett</label>
                        <input required type="number"  value="{{$model->nett}}" name="nett" 
                        class="form-control" placeholder="Nett">
                        @if($errors->has('nett'))
                         <p class="text-danger" >{{ $errors->first('nett') }}</p>
                        @endif 
                    </div>
                </div>



                  <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-info">Submit</button>
                  </div>
              </div> 
          </div>
      </section>
    </div>

    @if($model->nett)
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">Amount Demand And Received With Date Against This Consignment
                </h4>
            </header>
            <div class="card-body">

                <?php 
                   $data = json_decode($model->demands_received);
                ?>

                <div class="rows" >
                    @if( $data)
                    @foreach ($data as $key => $item)
                    <div class="row">
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input required name="data[{{$key}}][title]" class="form-control"
                                value="{{$item->title}}" >
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Demand">Demands</label>
                                <input required type="number" class="demand form-control" 
                                name="data[{{$key}}][demand]" value="{{$item->demand}}" >
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Received">Received</label>
                                <input required type="number" class="receive form-control" 
                                name="data[{{$key}}][received]" value="{{$item->received}}" />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Received">Pending</label>
                                <input readonly type="number" class="pending form-control" 
                                name="data[{{$key}}][pending]" value="{{$item->pending ?? ''}}" />
                            </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <div class="input-group">
                                    <input required type="date" 
                                    value="{{$item->date}}"
                                    name="data[{{$key}}][date]" class="form-control" />
                                    <div class="remove_btn input-group-append">
                                        <button class="btn btn-danger text-white" type="button">
                                        <i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                        @endforeach
                    @endif
                </div>

                <div class="row">
                    <div class="col-12 text-center ">
                        <button class="add_row btn btn-success text-white" type="button">
                        <i class="fa fa-plus"></i></button>
                    </div>
                </div>

                <div class="row pt-5 ">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            
            </div>
       </section>
    </div>
   @endif

   @if($model->nett)
   <div class="col-lg-12">
    <section class="card">
        <header class="card-header bg-info">
              <h4 class="mb-0 text-white">Documents</h4>
        </header>
        <div class="card-body">

         <?php $data = json_decode($model->documents); ?>

         <div class="document_rows" >
             @if( $data)
             @foreach ($data as $key => $item)
                <div class="row">
                    <div class="col-md-6 nopadding">
                        <div class="form-group">
                            <label for="title">Document Name</label>
                            <input required name="documents[{{$key}}][name]" class="form-control"
                            value="{{$item->name}}" >
                        </div>
                    </div>
                    <div class="col-md-6 nopadding">
                        <div class="form-group">
                            <label for="Date">Date</label>
                            <div class="input-group">
                                <input required type="date" 
                                value="{{$item->date}}"
                                name="documents[{{$key}}][date]" class="form-control" />
                                <div class="document_remove_btn input-group-append">
                                    <button class="btn btn-danger text-white" type="button">
                                    <i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 @endforeach
             @endif
         </div>

            <div class="row">
                <div class="col-12 text-center ">
                    <button class="document_add_row btn btn-success text-white" type="button">
                    <i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="row pt-5 ">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </div>
    </section>
   </div>
   @endif


</div>

</form>
@endsection
@section('js')
    
<script>
    $(document).ready(function() {

        function getRandomUniqueNumber() {
            const dateNow = Date.now();
            const randomNum = Math.floor(100000 + Math.random() * 900000);
            const uniqueNumber = dateNow.toString() + randomNum.toString();
            return uniqueNumber;
        }


        function calculatePrice(){
            $('.rows').children().each(function() {
                let el =  $(this);
                let demand = parseFloat(el.find('.demand').val()) || 0;
                let receive = parseFloat(el.find('.receive').val()) || 0; 
               el.find('.pending').val(demand - receive);
            });
        }

        calculatePrice();

        $('.rows').on('change', '.demand, .receive', function() {
            calculatePrice();  // Recalculate whenever the demand or receive changes
        });

        $('input[name=customer_email]').change(function (e) { 
            $('input[name=email]').val($(this).val());
        });

        
        $('.rows').on('click','.remove_btn', function () {
                $(this).parent().parent().parent().parent().remove();
        });


        $('.add_row').click(function(){

            let un = getRandomUniqueNumber();

            $('.rows').append(`<div class="row">

                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="data[${un}][title]" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Demand">Demands</label>
                                <input type="number" class="demand form-control" name="data[${un}][demand]" >
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Received">Received</label>
                                <input type="number" class="receive form-control" name="data[${un}][received]" />
                            </div>
                        </div>
                        <div class="col-sm-2 nopadding">
                            <div class="form-group">
                                <label for="Received">Pending</label>
                                <input readonly type="number" class="pending form-control" name="data[${un}][pending]" />
                            </div>
                        </div>
                        <div class="col-sm-3 nopadding">
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <div class="input-group">
                                    <input type="date" name="data[${un}][date]" class="form-control" />
                                    <div class="remove_btn input-group-append">
                                        <button class="btn btn-danger text-white" type="button">
                                        <i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);
             });

            //  Docuent


            $('.document_rows').on('click','.document_remove_btn', function () {
                $(this).parent().parent().parent().parent().remove();
            });


            $('.document_add_row').click(function(){

                let un = getRandomUniqueNumber();
                $('.document_rows').append(` <div class="row">
                        <div class="col-md-6 nopadding">
                            <div class="form-group">
                                <label for="title">Document Name</label>
                                <input required name="documents[${un}][name]" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 nopadding">
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <div class="input-group">
                                    <input required type="date" 
                                    value="$ {{$item->date}}"
                                    name="documents[${un}][date]" class="form-control" />
                                    <div class="document_remove_btn input-group-append">
                                        <button class="btn btn-danger text-white" type="button">
                                        <i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`);
        });

    });
</script>

@endsection