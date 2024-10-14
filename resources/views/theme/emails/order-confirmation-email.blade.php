<div>
    <p>Dear,{{ $customer_name }},</p>
    <p>Thank you for your order. Your order has been received. 
    Please wait for order confirmation call.</p>
    <p>Here are the details of your purchase:</p>
    <p>Please visit this link for order details: 
        <a target="_blank" href="{{URL::to('/order-confirmaton/')}}/{{$tracking_id}}">Click Here</a>
    </p> 
     <p>If you have any questions or concerns about your order, feel free to contact us at  or call us at .</p>
     <p>Thank you for shopping with us!</p>
    <p>Sincerely,</p>
    <p>{{$site_title}}</p>
</div>