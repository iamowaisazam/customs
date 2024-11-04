@extends('admin.partials.layout')
@section('css')
<style>
    .invalid-feedback{
      display: block;
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

            $order_item = array_values(array_filter(json_decode($model->items) ?? [], function($data) use($item) { return $data->product_id ?? '' == $item->product_id; }))[0] ?? null;
              
        
              $product_total = $item->total;
              $invoice_value = $consignment->invoice_value;

              $freight = intval($consignment->freight);
             
              $frieght_rate = ($product_total / $invoice_value) * $freight;
              
              $after_frieght = $frieght_rate + $product_total;


              $landing_charges = ($consignment->landing_charges / $invoice_value) * 100;
              $asset_value = $invoice_value + $landing_charges + $after_frieght + $consignment->ins_rs; 


        ?>

        <section class="card  ">
            <header class="card-header bg-info">
                  <h4 class="mb-0 text-white">{{$item->product->name}} ({{$item->product->sku}})</h4>
            </header>
            <div class="card-body">
                <input type="hidden" name="items[{{$key}}][product_id]" value="{{$item->product_id}}"  >
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Custom Duty :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->custom_duty ?? ''}}" name="items[{{$key}}][custom_duty]" class="custom_duty form-control" 
                            placeholder="Custom Duty" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Sale Tax :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->sale_tax ?? ''}}" name="items[{{$key}}][sale_tax]" class="sale_tax form-control" placeholder="Sale Tax" />  
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">R.D :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->rd ?? ''}}" name="items[{{$key}}][rd]" class="rd items form-control" placeholder="R.D" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Additional C.D :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->cd ?? ''}}" name="items[{{$key}}][cd]" class="cd form-control" placeholder="Additional C.D" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Additional S.T :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->st ?? ''}}" name="items[{{$key}}][st]" class="st form-control" placeholder="Additional S.T" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">ETO :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->eto ?? ''}}" name="items[{{$key}}][eto]" placeholder="ETO" class="eto form-control" placeholder="ETO" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="stan_duty form-label">STAN DUTY :</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->stan_duty ?? ''}}" 
                            name="items[{{$key}}][stan_duty]" class="stan_duty form-control" placeholder="STAN DUTY" 
                            />    
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">PSW FEE:</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->psw_fee ?? ''}}" name="items[{{$key}}][psw_fee]" class="psw_fee form-control" placeholder="PSW FEE" />    
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">DLAP FEE:</label>
                            <input type="number" style="width: 150px;" value="{{$order_item->dlap_fee ?? ''}}" name="items[{{$key}}][dlap_feee]" 
                            class="dlap_feee form-control" placeholder="DLAP FEE" />    
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Total :</label>
                            <input readonly style="width: 150px;" value="{{$order_item->total ?? ''}}" 
                            name="items[{{$key}}][total]"class="total form-control"/>
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
                            value="{{number_format( $after_frieght,2)}}" 
                            name="items[{{$key}}][value]" class="form-control" placeholder="Value" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Exchange Rate :</label>
                            <input readonly style="width: 150px;" value="{{$consignment->rate_of_exchange}}" name="items[{{$key}}][exchange_rate]" class="form-control" placeholder="Exchange Rate" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">INS. Memo : PKR</label>
                            <input readonly style="width: 150px;" value="{{$consignment->ins_rs}}" name="items[{{$key}}][ins_memo]" class="form-control" placeholder="INS. Memo" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Landing Charges : PKR</label>
                            <input readonly style="width: 150px;" value="{{number_format($landing_charges,2)}}" name="items[{{$key}}][landing_charges]" class="form-control" placeholder="Landing Charges" />
                        </div>
                        <div class="d-flex justify-content-between" >
                            <label class="form-label">Assets value : (PKR)</label>
                            <input readonly style="width: 150px;" value="{{number_format($asset_value,2)}}" name="items[{{$key}}][total_gif]" class="total_gif form-control" placeholder="Assets value" />
                         </div>
                      </div>
                    </div>
                </div>
         </section>
       @endforeach
    </div>
    

    @include('admin.payorders.accountsInfo')

    <div class="col-md-12 text-center">
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
                let total_gif = element.find('.total_gif').val() || 0;


                let custom_duty = element.find('.custom_duty').val() || 0;
                let sale_tax = element.find('.sale_tax').val() || 0;
                let rd = element.find('.rd').val() || 0;
                let cd = element.find('.cd').val() || 0;
                let st = element.find('.st').val() || 0;
                let eto = element.find('.eto').val() || 0;
                let stan_duty = element.find('.stan_duty').val() || 0;
                let psw_fee = element.find('.psw_fee').val() || 0;
                let dlap_feee = element.find('.dlap_feee').val() || 0;
                let total  = element.find('.total').val() || 0;


                subtotal += parseFloat(total_gif) || 0;


                if(custom_duty > 0){
                   let custom_duty_calc = (custom_duty / total_gif) * 100;
                   subtotal += custom_duty_calc;
                }

                if(sale_tax > 0){
                   sale_tax_calc = (sale_tax / total_gif) * 100;
                   subtotal += sale_tax_calc;
                }

                if(rd > 0){
                    rdcalc = (rd / total_gif) * 100;
                    subtotal += rdcalc;
                }

                if(cd > 0){
                    cdcalc = (cd / total_gif) * 100;
                    subtotal += cdcalc;
                }

                if(st > 0){
                    stcalc = (st / total_gif) * 100;
                    subtotal += stcalc;
                }

                if(eto > 0){
                    etocalc = (eto / total_gif) * 100;
                    subtotal += etocalc;
                }

                if(stan_duty > 0){
                    stan_dutycalc = (stan_duty / total_gif) * 100;
                    subtotal += stan_dutycalc;
                }

                if(psw_fee > 0){
                    psw_feecalc = (psw_fee / total_gif) * 100;
                    subtotal += psw_feecalc;
                }

                if(dlap_feee > 0){
                    dlap_feeecalc = (dlap_feee / total_gif) * 100;
                    subtotal += dlap_feeecalc;
                }

                element.find('.total').val(subtotal.toFixed(2));
                gtotal += subtotal;
            
            });

            $('.gtotal').val(gtotal.toFixed(2));


        }


        $('.custom_duty,.sale_tax,.rd,.cd,.st,.eto,.stan_duty,.psw_fee,.dlap_feee').change(function (e) { 
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