@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
   }

   .duties_label{
    width: 117px;

   }
</style>
@endsection

@section('content')

<?php

$ports = $_s['ports'] ? json_decode($_s['ports']) : [];
$port_of_shipments = $_s['port_of_shipment'] ? json_decode($_s['port_of_shipment']) : [];
$documents = $_s['documents'] ? json_decode($_s['documents']) : [];
$consignment = $model->consignment;

?>
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

<form method="post" action="{{URL::to('admin/payorders')}}/{{Crypt::encryptString($model->id)}}" >
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-12">
            @include('admin.payorders.consigmentInfo')
        </div>
        <div class="col-12 payorder_items">
       
       @foreach ($consignment->items as $key => $item)
          <?php 
              
              $frieght_rate = ($item->total / $consignment->invoice_value) * intval($consignment->freight);
              
              $value = $frieght_rate + $item->total;
              
              $rate_exchange = $consignment->rate_of_exchange * $value;
              
              $ins =  ($item->total / $consignment->invoice_value) * intval($consignment->insurance_in_pkr);

              $l = $rate_exchange + $ins;
              
              $landing_charges = ( $l / 100) * 1;

              $asset_value = $rate_exchange + $landing_charges + $ins; 
          ?>
        <section class="card">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">{{$item->name}} ({{$item->hs_code}})</h4>
            </header>
            <div class="card-body">
                <input type="hidden" name="items[{{$key}}][id]" value="{{$item->id}}"  />
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Custom Duty :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->custom_duty ?? ''}}" name="items[{{$key}}][custom_duty]" class="custom_duty form-control"  />
                            <input style="width: 150px;" readonly class="custom_duty_label form-control" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Additional C.D :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->a_custom_duty ?? ''}}" name="items[{{$key}}][a_custom_duty]" class="cd form-control" placeholder="Additional C.D" />
                            <input style="width: 150px;" readonly class="cd_label form-control" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">R.D :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->rd ?? ''}}" name="items[{{$key}}][rd]" class="rd items form-control" placeholder="R.D" />
                            <input style="width: 150px;" readonly class="rd_label form-control" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Sale Tax :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->saletax ?? ''}}" name="items[{{$key}}][saletax]" class="sale_tax form-control" placeholder="Sale Tax" />
                            <input style="width: 150px;" readonly class="sale_tax_label form-control" />  
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Additional S.T :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->a_saletax ?? ''}}" name="items[{{$key}}][a_saletax]" class="st form-control" placeholder="Additional S.T" />
                            <input style="width: 150px;" readonly class="st_label form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Income Tax :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->it ?? ''}}" name="items[{{$key}}][it]" class="income_tax form-control" placeholder="Income Tax" />
                            <input readonly style="width: 150px;" class="income_tax_label form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">ETO :</label>
                            <input step="0.0001" type="number" style="width: 150px;" value="{{$item->eto ?? ''}}" name="items[{{$key}}][eto]" class="eto form-control" placeholder="ETO" />
                            <input readonly style="width: 150px;" class="eto_label form-control" />
                        </div>
                        
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Total :</label>
                            <input  readonly style="width: 150px;" value="{{$item->after_duties}}" 
                            name="items[{{$key}}][after_duties]" class="total form-control"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Invoice Value : (USD)</label>
                            <input style="width: 150px;" value="{{$item->total}}" readonly name="items[{{$key}}][total]" class="form-control" placeholder="Invoice Value" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Freight If Any : (USD)</label>
                            <input readonly style="width: 150px;" value="{{number_format( $frieght_rate,2)}}"  class="form-control" placeholder="Freight" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Value :</label>
                            <input readonly style="width: 150px;" 
                            value="{{number_format( $frieght_rate + $item->total,2)}}" class="form-control" placeholder="Value" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Invoice value (ER {{$consignment->rate_of_exchange}}) : (PKR)</label>
                            <input readonly style="width: 150px;" value="{{number_format($rate_exchange,2)}}" class="form-control" placeholder="Exchange Rate" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Insurance : (PKR)</label>
                            <input readonly style="width: 150px;" value="{{number_format($ins,2)}}" class="form-control" placeholder="INS. Memo" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Landing Charges (1%) : PKR</label>
                            <input readonly style="width:150px;" value="{{number_format($landing_charges,2)}}" class="form-control" placeholder="Landing Charges" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Assessed value : (PKR)</label>
                            <input readonly style="width: 150px;" value="{{number_format($asset_value,2)}}"  class="total_gif form-control" placeholder="Assets value" />
                            <input type="hidden" value="{{$asset_value}}" class="total_gif_value" />
                         </div>
                      </div>
                    </div>
                </div>
         </section>
       @endforeach


       <div class="accounts col-lg-12">
        <section class="card">
            <header class="card-header bg-info">
                <h4 class="mb-0 text-white">Additional Duties</h4>
            </header>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Stamp Duty</label>
                            <input step="0.0001"  required name="stan_duty"  type="number"  value="{{$model->stan_duty}}" class="stan_duty form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">PSW Fee</label>
                            <input step="0.0001"  required name="psw_fee"  type="number"  value="{{$model->psw_fee}}" class="psw_fee form-control" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">DRAP Fee</label>
                            <input step="0.0001"  required name="drap_fee"  type="number" value="{{$model->drap_fee}}" class="drap_fee form-control" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
       </div>
       </div>

        <div class="accounts col-lg-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">Accounts</h4>
                </header>
                <div class="card-body">
                    <?php 
                        $header = json_decode($model->header);
                        $footers = $model->footer ? json_decode($model->footer) : []; 
                    ?>
        
                    <div class="row">
                        <div class="col-md-5 nopadding">
                            <div class="form-group">
                                <label>Account</label>
                                <select name="header[title]" class="form-control mt-2" >
                                    @foreach ($accounts as $item)
                                      <option @if($header && $header->title == $item) selected @endif value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 nopadding">
                            <div class="form-group">
                               <label>Amount</label>
                               <input  readonly value="{{$header->amount ?? ''}}" name="header[amount]" class="gtotal form-control mt-2" />
                            </div>
                        </div>
                        <div class="col-md-5 nopadding">
                            <div class="form-group">
                                <label>Pay Order In Favor OF</label>
                                <select name="header[company]" class="form-control mt-2">
                                    @foreach ($favors as $item)
                                    <option @if($header && $header->company == $item) selected @endif value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="data_rows">
                        @foreach ($footers as $key => $f)
                        <div class="row">
                                <div class="col-md-5 nopadding">
                                    <div class="form-group">
                                        <label class="pb-2" >Account</label>
                                        <select name="footer[{{$key}}][title]" class="form-control">
                                            @foreach ($accounts as $item)
                                             <option @if($f->title == $item) selected @endif value="{{$item}}">{{$item}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 nopadding">
                                        <label class="pb-2" >Amount</label>
                                        <input value="{{$f->amount}}" name="footer[{{$key}}][amount]" class="form-control" />
                                </div>
                                <div class="col-md-5 nopadding">
                                    <label class="pb-2" >Pay Order In Favor OF</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select name="footer[{{$key}}][company]" class="form-control">
                                                @foreach ($favors as $item)
                                                 <option @if($f->company == $item) selected @endif value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                            <div class="remove_btn input-group-append">
                                                <button class="btn btn-danger text-white" type="button">
                                                <i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12 text-center ">
                            <button class="add_row btn btn-success text-white" type="button">
                            <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="pb-5 pt-3 col-md-12 text-center">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </div>
</form>


@endsection
@section('js')
    
<script>
    $(document).ready(function() {

        

        let options1 = @json($accounts);
        let options2 = @json($favors);

        let optionsHtml1 = '';
        for (let key in options1) {
            optionsHtml1 += `<option value="${key}">${options1[key]}</option>`;
        }

        let optionsHtml2 = '';
        for (let key in options2) {
            optionsHtml2 += `<option value="${key}">${options2[key]}</option>`;
        }

        console.log(options1);
        

        

        function calculate(){

          



            let gtotal = 0;

            $('.payorder_items').children().each(function() {

                

                subtotal = 0;
                
                let element = $(this);
                let total_gif = parseFloat(element.find('.total_gif_value').val()) || 0;
                let income_tax = parseFloat(element.find('.income_tax').val()) || 0;
                let custom_duty = parseFloat(element.find('.custom_duty').val()) || 0;
                let sale_tax = parseFloat(element.find('.sale_tax').val()) || 0;
                let rd = parseFloat(element.find('.rd').val()) || 0;
                let cd = parseFloat(element.find('.cd').val()) || 0;
                let st = parseFloat(element.find('.st').val()) || 0;  
                let eto = parseFloat(element.find('.eto').val()) || 0;                


                let custom_duty_calc = ( total_gif / 100) * custom_duty;
                subtotal += custom_duty_calc;
                element.find('.custom_duty_label').val(custom_duty_calc.toFixed(2));
                
                let cd_calc = (total_gif / 100) * cd;
                subtotal += cd_calc;
                element.find('.cd_label').val(cd_calc.toFixed(2));
                
                let rd_calc = (total_gif / 100) * rd;
                subtotal += rd_calc;
                element.find('.rd_label').val(rd_calc.toFixed(2));
                
                sale_tax_calc = total_gif + custom_duty_calc + cd_calc + rd_calc; 
                sale_tax_calc = (sale_tax_calc / 100) * sale_tax;
                subtotal += sale_tax_calc;
                element.find('.sale_tax_label').val(sale_tax_calc.toFixed(2));

                st_calc = total_gif + custom_duty_calc + cd_calc + rd_calc; 
                st_calc = (st_calc / 100) * st;
                subtotal += st_calc;
                element.find('.st_label').val(st_calc.toFixed(2));
            
                
                // if(custom_duty_calc > 0 || cd_calc > 0 || rd_calc > 0 || sale_tax_calc> 0 || st_calc){
                   it_calc = total_gif + custom_duty_calc + cd_calc + rd_calc + sale_tax_calc + st_calc;
                   it_calc = (it_calc / 100) * income_tax;
                   subtotal += it_calc;   
                   element.find('.income_tax_label').val(it_calc.toFixed(2));
                // }else{
                    // element.find('.income_tax_label').val(0);
                // }

                eto = (eto / 100) * total_gif;
                subtotal += eto;
                element.find('.eto_label').val(eto.toFixed(2));

                element.find('.total').val(subtotal.toFixed(2));
                gtotal += subtotal;
                
            });

            gtotal += parseFloat($('.stan_duty').val()) || 0;
            gtotal += parseFloat($('.psw_fee').val()) || 0;
            gtotal += parseFloat($('.drap_fee').val()) || 0;
            
            $('.gtotal').val(gtotal.toFixed(2));

        }


        $('.custom_duty,.sale_tax,.rd,.income_tax,.cd,.st,.eto,.stan_duty,.psw_fee,.drap_fee').change(function (e) { 
            calculate();
        });

        calculate();


        $('.add_row').click(function(){

                 let un = getRandomUniqueNumber();

                $('.data_rows').append(`<div class="row">
                <div class="col-md-5 nopadding">
                    <div class="form-group">
                        <label>Account</label>
                        <select class="form-control mt-2" name="footer[${un}][title]" > 
                            ${optionsHtml1}
                        </select>
                    </div>
                </div>
                <div class="col-md-2 nopadding">
                    <div class="form-group">
                      <label>Amount</label>
                      <input value="" name="footer[${un}][amount]" class="form-control mt-2" />
                    </div>
                </div>
                <div class="col-md-5 nopadding">
                    <div class="form-group">
                        <label>Pay Order In Favor OF</label>
                        <div class="input-group">
                            <select class="form-control mt-2" name="footer[${un}][company]" > 
                                ${optionsHtml2}
                            </select>
                            <div class="remove_btn input-group-append">
                                <button class="btn btn-danger text-white" type="button">
                                <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`);
        });


        $('.accounts').on('click','.remove_btn', function () {
           $(this).parent().parent().parent().parent().remove();
        });

    });
</script>

@endsection