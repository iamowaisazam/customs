@push('css')

    <style>
        .select2-selection {
            height: 37px!important;
        }
    </style>
    
@endpush


<?php 
    if(isset($model)){
        $data = $model->items;
    }else{
        $data = [];
    }

    $products = App\Models\Product::where('status',1)->get();
    
?>

 <section class="consignment-price card">
    <header  class="py-4 card-header d-flex justify-content-between">
        <h4 class="mb-0 text-white ">Amount Demand And Received With Date Against This Consignment</h4>
        <button class="add_row btn btn-success text-white" type="button">
            <i class="fa fa-plus"></i></button>
    </header>
    <div class="card-body">
        <div class="rows" >
        </div>
        <div class="price-summary">
          <div class="row" >
            <div class="col-md-10 text-end"><p><b>Total Quantity </b></p></div>
            <div class="col-md-2 total_quantity"> : <span>0</span></div>
          </div>
          <div class="row">
            <div class="col-md-10 text-end"><p><b>Total Value </b></p></div>
            <div class="col-md-2 total_value"> : <span>0</span></div>
          </div>
       </div>
    </div>
  </section>
  




@push('js')

<script>
    $(document).ready(function() {

        const products = @json($products);
        const items = @json($data);
        const units = @json($units);

        console.log(units);
        

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

            $('.price-summary .total_quantity span').text(total_quantity);
            $('.price-summary .total_value span').text(total);

        }

        
        consignment_price.find('.rows').on('change', '.qty, .price', function() {
            calculatePrice();
        });

        consignment_price.find('.rows').on('click','.remove_btn', function () {
            $(this).parent().parent().parent().parent().remove();
            calculatePrice();
        });

        function renderTemplate(data) {

            let un = getRandomUniqueNumber();

            let pOptions = '';
            products.forEach(element => {
                let selected = element.id == data.product_id ? 'selected' : '';
                pOptions += `<option ${selected} value="${element.id}">${element.name}-${element.sku}</option>`;
            });

            let ounits = '';
            units.forEach(u => {
                let selected = u == data.unit ? 'selected' : '';
                console.log(data.unit);
                
                ounits += `<option ${selected} value="${u}">${u}</option>`;
            });

            let template = `
                <div class="row">
                    <input type="hidden" value="${data.id ?? ''}" name="data[${un}][id]" />
                    <div class="col-sm-3 nopadding">
                        <div class="form-group">
                            <label for="title">Item Name</label><br>
                            <select name="data[${un}][product_id]" class="form-control js-example-basic-single">${pOptions}</select>
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input class="form-control" 
                            name="data[${un}][description]"value="${data.description ?? ''}" />
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="Quantity">Quantity</label>
                            <input type="number" class="qty form-control" 
                            name="data[${un}][qty]" value="${data.qty}"  />
                        </div>
                    </div>
                      <div class="col-sm-1 nopadding">
                        <div class="form-group">
                            <label for="title">Unit</label><br>
                            <select name="data[${un}][unit]" class="form-control">${ounits}</select>
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="Received">Amount</label>
                            <input  type="number" class="price form-control" 
                            name="data[${un}][price]" value="${data.price}" />
                        </div>
                    </div>
                    <div class="col-sm-2 nopadding">
                        <div class="form-group">
                            <label for="Date">Total</label>
                            <div class="input-group">
                                <input readonly type="number" name="data[${un}][total]"
                                value="${data.total}" class="total form-control" />
                                <div class="remove_btn input-group-append">
                                    <button class="btn btn-danger text-white" type="button">
                                    <i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;

            consignment_price.find('.rows').append(template);
            $('.js-example-basic-single').select2();

            calculatePrice();

        }

        items.forEach(element => {
            renderTemplate({
                id:element.id,
                product_id:element.product_id,
                description:element.description,
                qty:element.qty,
                price:element.price,
                total:element.total,
                unit:element.unit,
            });
        });
       

        consignment_price.find('.add_row').click(function(){
            renderTemplate({});
        });


          
         


    });
</script>



@endPush
