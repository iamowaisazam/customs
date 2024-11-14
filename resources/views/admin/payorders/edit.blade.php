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

              $rate_exchange = $consignment->rate_of_exchange * $item->total;

              $ins =  ($item->total / $consignment->invoice_value) * intval($consignment->ins_rs);

              $landing_charges = ( $item->total / 100) * 1;

              $asset_value = $frieght_rate + $rate_exchange + $landing_charges + $ins; 
        ?>

        <section class="card  ">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">{{$item->name}} ({{$item->hs_code}})</h4>
            </header>
            <div class="card-body">
                <input type="hidden" name="items[{{$key}}][id]" value="{{$item->id}}"  />
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Custom Duty :</label>
                            <input type="number" style="width: 150px;" value="{{$item->custom_duty ?? ''}}" name="items[{{$key}}][custom_duty]" class="custom_duty form-control"  />
                            <input style="width: 150px;" readonly class="custom_duty_label form-control" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Additional C.D :</label>
                            <input type="number" style="width: 150px;" value="{{$item->a_custom_duty ?? ''}}" name="items[{{$key}}][a_custom_duty]" class="cd form-control" placeholder="Additional C.D" />
                            <input style="width: 150px;" readonly class="cd_label form-control" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">R.D :</label>
                            <input type="number" style="width: 150px;" value="{{$item->rd ?? ''}}" name="items[{{$key}}][rd]" class="rd items form-control" placeholder="R.D" />
                            <input style="width: 150px;" readonly class="rd_label form-control" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Sale Tax :</label>
                            <input type="number" style="width: 150px;" value="{{$item->saletax ?? ''}}" name="items[{{$key}}][saletax]" class="sale_tax form-control" placeholder="Sale Tax" />
                            <input style="width: 150px;" readonly class="sale_tax_label form-control" />  
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Additional S.T :</label>
                            <input type="number" style="width: 150px;" value="{{$item->a_saletax ?? ''}}" name="items[{{$key}}][a_saletax]" class="st form-control" placeholder="Additional S.T" />
                            <input style="width: 150px;" readonly class="st_label form-control" />
                        </div>

                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Income Tax :</label>
                            <input type="number" style="width: 150px;" value="{{$item->it ?? ''}}" name="items[{{$key}}][it]" class="income_tax form-control" placeholder="Income Tax" />
                            <input readonly style="width: 150px;"  class="income_tax_label form-control" />
                        </div>
                        
                        <div class="d-flex justify-content-between" >
                            <label class="duties_label form-label">Total :</label>
                            <input readonly style="width: 150px;" value="{{$item->after_duties ?? ''}}" 
                            name="items[{{$key}}][after_duties]"class="total form-control"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Invoice Value : (USD)</label>
                            <input style="width: 150px;" value="{{$item->total}}" readonly name="items[{{$key}}][invoice_value]" class="form-control" placeholder="Invoice Value" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Freight If Any : (USD)</label>
                            <input readonly style="width: 150px;" value="{{number_format( $frieght_rate,2)}}" 
                            name="items[{{$key}}][freight]" class="form-control" placeholder="Freight" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Value :</label>
                            <input readonly style="width: 150px;" 
                            value="{{number_format( $frieght_rate + $item->total,2)}}" 
                            name="items[{{$key}}][value]" class="form-control" placeholder="Value" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Exchange Rate :</label>
                            <input readonly style="width: 150px;" value="{{$rate_exchange}}" name="items[{{$key}}][exchange_rate]" class="form-control" placeholder="Exchange Rate" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">INS. Memo : PKR</label>
                            <input readonly style="width: 150px;" value="{{number_format($ins,2)}}" name="items[{{$key}}][ins_memo]" class="form-control" placeholder="INS. Memo" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Landing Charges : PKR</label>
                            <input readonly style="width: 150px;" value="{{number_format($landing_charges,2)}}" name="items[{{$key}}][landing_charges]" class="form-control" placeholder="Landing Charges" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Assets value : (PKR)</label>
                            <input readonly style="width: 150px;" value="{{number_format($asset_value,2)}}" name="items[{{$key}}][total_gif]" class="total_gif form-control" placeholder="Assets value" />

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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">ETO</label>
                            <input name="eto" type="number" value="{{$model->eto}}" class="eto form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Stan Duty</label>
                            <input name="stan_duty"  type="number"  value="{{$model->stan_duty}}" class="stan_duty form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">PSW Fee</label>
                            <input name="psw_fee"  type="number"  value="{{$model->psw_fee}}" class="psw_fee form-control" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">DRAP Fee</label>
                            <input name="drap_fee"  type="number" value="{{$model->drap_fee}}" class="drap_fee form-control" />
                        </div>
                    </div>
                </div>

            </div>
        </section>
       </div>


    </div>
    

    @include('admin.payorders.accountsInfo')

    <div class="pb-5 pt-3 col-md-12 text-center">
        <button type="submit" class="btn btn-info">Submit</button>
    </div>

</div>

</form>


@endsection
@section('js')
    
<script>
    $(document).ready(function() {

        let documents = @json(json_decode($model->footer));


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
                let total  = parseFloat(element.find('.total').val()) || 0;

                subtotal += parseFloat(total_gif) || 0;
                

                // if(custom_duty > 0){
                
                   let custom_duty_calc = ( total_gif / 100) * custom_duty;
                   subtotal += custom_duty_calc;
                   element.find('.custom_duty_label').val(custom_duty_calc);
                // }

                // if(cd > 0){
                   let cd_calc = (total_gif / 100) * cd;
                   subtotal += cd_calc;
                   element.find('.cd_label').val(cd_calc);
                // }

                // if(rd > 0){
                   let rd_calc = (total_gif / 100) * rd;
                   subtotal += rd_calc;
                   element.find('.rd_label').val(rd_calc);
                // }

                // if(sale_tax > 0){
                   sale_tax_calc = total_gif + custom_duty_calc + cd_calc + rd_calc; 
                   sale_tax_calc = (sale_tax_calc / 100) * sale_tax;
                   subtotal += sale_tax_calc;
                   element.find('.sale_tax_label').val(sale_tax_calc);
                // }

                // if(st > 0){
                   st_calc = total_gif + custom_duty_calc + cd_calc + rd_calc; 
                   st_calc = (st_calc / 100) * st;
                   subtotal += st_calc;
                   element.find('.st_label').val(st_calc);
                // }

                
                if(custom_duty_calc > 0 || cd_calc > 0 || rd_calc > 0 || sale_tax_calc> 0 || st_calc){
               
                   it_calc = total_gif + custom_duty_calc + cd_calc + rd_calc + sale_tax_calc + st_calc;
                   it_calc = (it_calc / 100) * income_tax;
                   subtotal += it_calc;   
                   element.find('.income_tax_label').val(it_calc);
                }else{
                    element.find('.income_tax_label').val(0);
                }

                element.find('.total').val(subtotal.toFixed(2));
                gtotal += subtotal;
            
            });

            gtotal += parseFloat($('.eto').val()) || 0;
            gtotal += parseFloat($('.stan_duty').val()) || 0;
            gtotal += parseFloat($('.psw_fee').val()) || 0;
            gtotal += parseFloat($('.drap_fee').val()) || 0;
            
            $('.gtotal').val(gtotal.toFixed(2));

        }


        $('.custom_duty,.sale_tax,.rd,.income_tax,.cd,.st,.eto,.stan_duty,.psw_fee,.dlap_feee').change(function (e) { 
            calculate();
        });

        calculate();

        let accounts = document.querySelector('.accounts');

        function loadTemplate(data) {

            let un = getRandomUniqueNumber();

            let tmp =`<div class="row row_id_${un}">
                        <div class="col-md-5 nopadding">
                            <div class="form-group">
                                <label>Account</label>
                                <input value="${data.title ?? ''}" name="footer[${un}][title]" 
                                class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-2 nopadding">
                                <label>Amount</label>
                                <input value="${data.amount ?? ''}" name="footer[${un}][amount]" class="form-control" />
                        </div>
                        <div class="col-md-5 nopadding">
                            <div class="form-group">
                                <label>Pay Order In Favor OF</label>
                                <div class="input-group">
                                    <input value="${data.company ?? ''}" name="footer[${un}][company]" 
                                    class="form-control" />
                                    <div class="remove_btn input-group-append">
                                        <button class="btn btn-danger text-white" type="button">
                                        <i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>`;
                accounts.querySelector('.data_rows').innerHTML  += tmp;
        }


        accounts.querySelector('.add_row').addEventListener('click',function(){

            loadTemplate({});
        });

        $('.accounts').on('click','.remove_btn', function () {
           $(this).parent().parent().parent().parent().remove();
        });

        for (let key in documents) {
            loadTemplate({
                title:documents[key].title,
                amount:documents[key].amount,
                company:documents[key].company,
            });
        }

    });
</script>

@endsection