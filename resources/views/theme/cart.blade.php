@extends('theme.layout')

@section('metatags')
    <title>Cart</title>
    <meta name="description" content="{{$_s['meta_description']}}">
    <meta name="keywords" content="{{$_s['meta_keywords']}}">
@endsection
@section('css')
  
@endsection
@section('content')

<?php 
//dd($carts);
?>
<div id="page-content" class="template-collection">

    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper"><h1 class="page-title">Cart Item List </h1></div>
        </div>
    </div>

    <div class="my_cart_form container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-12 col-sm-12 col-md-12 col-lg-8 main-col">
                <form action="#" method="post" class="cart style2">
                    <table class="my_cart_form_table" >
                        <thead class="cart__row cart__header">
                            <tr>
                                <th colspan="2" class="text-center">Product</th>
                                <th class="d-none d-md-table-cell text-center">Price</th>
                                <th class="d-none d-md-table-cell text-center">Quantity</th>
                                <th class="d-none d-md-table-cell text-center">Total</th>
                                <th class="d-none d-md-table-cell action">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-start">
                                    <a href="{{URL::to('/shop')}}" 
                                      class="btn btn--link btn--small cart-continue">
                                      <i class="icon an an-chevron-circle-left"></i> 
                                       Continue Shopping</a>
                                </td>
                                <td colspan="3" class="text-end">
                                    <a href="{{URL::to('/cart/cart_clear')}}"  class="btn btn--link btn--small small--hide"><i class="icon an an-times"></i> 
                                        Clear Shopping Cart</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table> 
                </form>                   
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart__footer">
                <div class="solid-border">
                    <div class="row border-bottom pb-2 pt-2">
                        <span class="col-12 col-sm-6 cart__subtotal-title text-center text-sm-end">
                            <strong>Subtotal</strong>
                        </span>
                        <span class="text-center text-sm-start col-12 col-sm-6 cart__subtotal-title cart__subtotal ">
                            <span class="money subtotal"></span>
                        </span>
                    </div>	
                    <div class="row border-bottom pb-2 pt-2">
                        <span class="col-12 col-sm-6 cart__subtotal-title text-center text-sm-end">
                            <strong>Delivery Charges</strong>
                        </span>
                        <span class="text-center text-sm-start col-12 col-sm-6 cart__subtotal-title cart__subtotal ">
                            <span class="money delivery_charges "></span>
                        </span>
                    </div>
                    <div class="row border-bottom pb-2 pt-2">
                        <span class="col-12 col-sm-6 cart__subtotal-title text-center text-sm-end">
                            <strong>Grand Total</strong>
                        </span>
                        <span class="text-center text-sm-start col-12 col-sm-6 cart__subtotal-title cart__subtotal ">
                            <span class="money grand_total "></span>
                        </span>
                    </div>
                    <a href="{{URL::to('/checkout')}}" 
                       id="cartCheckout" 
                       class="btn btn--small-wide checkout">
                        Proceed To Checkout
                    </a>
                    <div class="paymnet-img">
                        <img src="{{asset('theme/assets/images/payment-img.jpg')}}"/>
                    </div>
                </div>
            </div>


            <div class="container mt-4">
                <div class="row">
                    <div class=" col-12 col-sm-12 col-md-6 col-lg-4 mb-4 cart-col">
                        
                    </div>
                    <div class=" col-12 col-sm-12 col-md-6 col-lg-4 mb-4 cart-col">
                      
                    </div>

                    
                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>

  




</div>
@endsection
@section('js')

<script>

$(document).ready(function () {
    

    //Get Cart Form
    function get_cart_form() {
        
        if(!$('.my_cart_form')){
            return false;
        }


        $('.my_cart_form_table tbody').html('');

        $.ajax({
            type: "get",
            url: site_url+"/cart/get_cart_details",
            data: {
            },
            dataType: "json",
            success: function (response) {
                
                

            if(response.subtotal != 0){
                $('.subtotal').text("PKR "+response.subtotal);
                $('.delivery_charges').text("PKR "+response.delivery_charges);
                $('.grand_total').text("PKR "+response.grand_total);
            }else{
                $('.subtotal').text(" ");
                $('.delivery_charges').text(" ");
                $('.grand_total').text(" ");
            }

                response.cart_items.forEach(element => {

                    let attr = "";
                    element.attributes.forEach(element => {
                        attr += element.attribute_title+" : "+ element.values_title+"<br>";
                    });

                 $('.my_cart_form_table tbody').append(`
                    <tr class="cart__row border-bottom line1 cart-flex border-top">
                    <td class="cart__image-wrapper cart-flex-item">
                        <a href="${element.link}">
                            <img class="cart__image blur-up lazyloaded" 
                             data-src="${element.image}" 
                             src="${element.image}">
                        </a>
                    </td>
                    <td class="cart__meta small--text-left cart-flex-item">
                        
                        
                        <div class="list-view-item__title">
                            <a href="${element.link}">
                             ${element.title} - ${element.sku} 
                            </a>
                        </div>
                        <div class="cart__meta-text">${attr}</div>
                        <div class="d-block d-md-none cart__meta-text">
                            Price: ${response.currency} ${element.price}<br>
                            Quantity: ${element.cart_qty}<br>
                            Total: ${response.currency}  ${element.total} 
                       </div>
                        <div class="d-block d-md-none cart__qty text-left mt-2">
                            <div class="qtyField m-0">
                                <a class="qtyBtn minus" 
                                     data-id="${element.variation_id}"
                                     data-action="decreament"
                                    href="javascript:void(0);">
                                    <i class="icon an an-minus"></i>
                                </a>
                                <input readOnly class="qty" type="text"  
                                  value="${element.cart_qty}" 
                                  pattern="[0-9]*">
                                <a   class="qtyBtn plus"
                                     data-id="${element.variation_id}"
                                     data-action="increament" 
                                     href="javascript:void(0);">
                                    <i class="icon an an-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-block d-md-none text-center">
                            <a data-id="${element.variation_id}" 
                               class="m-auto btn btn--secondary cart__remove" 
                               data-bs-toggle="tooltip" 
                               data-bs-placement="top" 
                               data-bs-original-title="Remove item">
                               <i class="icon an an-times"></i>
                            </a>
                        </div>
                        
                    </td>
                    <td class="d-none d-md-table-cell cart__price-wrapper cart-flex-item text-center">
                        <span class="money">${response.currency} ${element.price}</span>
                    </td>
                    <td style="width: 150px;" class="d-none d-md-table-cell cart__update-wrapper cart-flex-item text-center">
                        <div class="cart__qty text-center">
                            <div class="qtyField">
                                <a class="qtyBtn minus" 
                                     data-id="${element.variation_id}"
                                     data-action="decreament"
                                    href="javascript:void(0);">
                                    <i class="icon an an-minus"></i>
                                </a>
                                <input readOnly class="qty" type="text"  
                                  value="${element.cart_qty}" 
                                  pattern="[0-9]*">
                                <a   class="qtyBtn plus"
                                     data-id="${element.variation_id}"
                                     data-action="increament" 
                                     href="javascript:void(0);">
                                    <i class="icon an an-plus"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell cart-price text-center">
                        <span class="money">${response.currency} ${element.total}</span>
                    </td>
                    <td class="d-none d-md-table-cell text-center">
                        <a  data-id="${element.variation_id}" 
                            class="btn btn--secondary cart__remove" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            title="" 
                            data-bs-original-title="Remove item">
                           <i class="icon an an-times"></i>
                        </a>
                    </td>
                 </tr>`);
              });

              $('.site-header-cart').trigger('click');

            },
            error:function (response) {

            },
        });

    }


    

    // Update Cart
     $(".my_cart_form").delegate(".qtyBtn", "click", function(){
        
         let vid = $(this).data('id');
         let action = $(this).data('action');
      
          $.ajax({
                type: "get",
                url: site_url+"/cart/add_to_cart",
                data: {
                sku:vid,
                action:action,
                },
                dataType: "json",
                success: function (response) {
                
                    $.toast({
                        heading:"success",
                        text: response.message,
                        position:'top-right',
                        loaderBg:'#ff6849',
                        icon:'success',
                        hideAfter: 3500,
                        stack: 6,
                    });

                    get_cart_form();
                    
                },
                error:function (response) {

                    $.toast({
                        heading: "error",
                        text: response.message ? response.message : 'Error Found' ,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500,
                        stack: 6,
                    });

                    get_cart_form();
                    
                },
                
            });
     });


      //Remove Cart
    $(".my_cart_form").delegate(".cart__remove", "click", function(){
        let vid = $(this).data('id');
        $.ajax({
            type:"get",
            url: site_url+"/cart/remove/"+vid,
            dataType: "json",
            success: function (response) {
            
                $.toast({
                    heading: "success",
                    text: response.message,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3500,
                    stack: 6,
                });

                get_cart_form();

            },
            error:function (response) {

                $.toast({
                    heading: "error",
                    text: response.message ? response.message : 'Error Found' ,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6,
                });

                get_cart_form();
               
            },
        });

    });
    
    get_cart_form();

});

</script>



@endsection