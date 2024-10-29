

<?php 
if(isset($model)){
    $data = json_decode($model->demands_received);
}else{
    $data = [];
}
?>

<section class="consignment-price card">
    <header style="border-bottom: 1px solid " class="py-4 card-heade">
        <h4 class="mb-0 ">Amount Demand And Received With Date Against This Consignment</h4>
    </header>
    <div class="card-body">
        <div class="rows" >
            @if($data)
            @foreach ($data as $key => $item)
                <div class="row">
                    <div class="col-sm-3 nopadding">
                        <div class="form-group">
                            <label for="title">Title Name</label>
                            <input name="data[{{$key}}][title]" class="form-control" 
                            value="{{$item->title}}" >
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="HS Code">HS Code</label>
                            <input class="form-control" name="data[{{$key}}][hs_code]"
                            value="{{$item->hs_code}}" >
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="Quantity">Quantity</label>
                            <input type="number" class="qty form-control" name="data[{{$key}}][qty]"
                            value="{{$item->qty}}" />
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="Received">Unit Value</label>
                            <input  type="number" class="price form-control" name="data[{{$key}}][price]" value="{{$item->price}}" />
                        </div>
                    </div>
                    <div class="col-sm-3 nopadding">
                        <div class="form-group">
                            <label for="Date">Total</label>
                            <div class="input-group">
                                <input readonly type="number" name="data[{{$key}}][total]"
                                value="{{$item->total}}" class="total form-control" />
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
            <div class="col-md-12 text-center">
                <button class="add_row btn btn-success text-white" type="button">
                    <i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center ">
           
            </div>
        </div>
    </div>
  </section>




@push('js')

<script>
    $(document).ready(function() {

        let consignment_price = $('.consignment-price');
       
        function calculatePrice(){
            let total = 0;
            let total_quantity = 0;
            consignment_price.find('.rows').children().each(function() {
                let el =  $(this);
                let qty = parseFloat(el.find('.qty').val()) || 0;
                let price = parseFloat(el.find('.price').val()) || 0; 
                let t = qty * price;
                total_quantity += qty;

                el.find('.total').val(t);
                total += t;
            });

            $('input[name=invoice_value]').val(total);
            $('input[name=total_quantity]').val(total_quantity);
        }

        calculatePrice();

        consignment_price.find('.rows').on('change', '.qty, .price', function() {
            calculatePrice();
        });

        consignment_price.find('.rows').on('click','.remove_btn', function () {
            $(this).parent().parent().parent().parent().remove();
        });


        consignment_price.find('.add_row').click(function(){
        
            let un = getRandomUniqueNumber();
            consignment_price.find('.rows').append(`<div class="row">

                <div class="col-sm-3 nopadding">
                    <div class="form-group">
                        <label for="title">Title Name</label>
                        <input name="data[${un}][title]" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2 nopadding">
                    <div class="form-group">
                        <label for="HS Code">HS Code</label>
                        <input class="form-control" name="data[${un}][hs_code]" >
                    </div>
                </div>
                <div class="col-sm-2 nopadding">
                    <div class="form-group">
                        <label for="Quantity">Quantity</label>
                        <input type="number" class="qty form-control" name="data[${un}][qty]" />
                    </div>
                </div>
                <div class="col-sm-2 nopadding">
                    <div class="form-group">
                        <label for="Received">Unit Value</label>
                        <input  type="number" class="price form-control" name="data[${un}][price]" />
                    </div>
                </div>
                <div class="col-sm-3 nopadding">
                    <div class="form-group">
                        <label for="Date">Total</label>
                        <div class="input-group">
                            <input readonly type="number" name="data[${un}][total]" class="total form-control" />
                            <div class="remove_btn input-group-append">
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

@endPush
