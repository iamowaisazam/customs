<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pagesData=[
            [
                'title'=>'Contact Us',
                'slug'=>'contact-us',
                'longdetails'=>'
                <h2>Get in Touch with Us</h2>
                <p>We’re here to help and answer any questions you might have. We look forward to hearing from you!</p>
                <h2>Contact Information</h2>
                <p><b>Email:</b> [your.email@example.com] </p>
                <p><b>Phone:</b> [Your Phone Number] </p>
                <p><b>Address:</b> [Your Physical Address, if applicable </p>
                <h2>Business Hours </h2>
                <p> Monday - Friday: 9:00 AM - 6:00 PM </p>
                <p>Saturday: 10:00 AM - 4:00 PM </p>
                <p>Sunday: Closed </p>

                <h2>Follow Us </h2>
                <p>Stay connected with us through social media:</p>

                <p>[Facebook Icon] [Facebook URL] </p>
                <p>[Twitter Icon] [Twitter URL] </p>
                <p>[Instagram Icon] [Instagram URL] </p>
                <p>[LinkedIn Icon] [LinkedIn URL] </p>
                ',
            ],
            [
                'title'=>'Terms & Conditions',
                'slug'=>'terms-conditions',
                'longdetails'=>'
                  <h2> TERMS </h2>
                   <p> By accessing the website at http://www.mstore.com/, you are agreeing to be bound by these terms of service, all applicable laws and regulations, and agree that you are responsible for compliance with any applicable local laws. If you do not agree with any of these terms, you are prohibited from using or accessing this site. The materials contained in this website are protected by applicable copyright and trademark law.</p>

           <h2> USE LICENSE </h2>
            <p> Permission is granted to temporarily download one copy of the materials (information or software) on MSTORE`s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license, you may not:
            modify or copy the materials;
            use the materials for any commercial purpose, or for any public display (commercial or non-commercial);
            attempt to decompile or reverse engineer any software contained on MSTORE`s website;
            remove any copyright or other proprietary notations from the materials; or
            transfer the materials to another person or "mirror" the materials on any other server.
            This license shall automatically terminate if you violate any of these restrictions and may be terminated by MSTORE at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format. </p>

           <h2> DISCLAIMER </h2>
            <p>The materials on MSTORE`s website are provided on an `as is` basis. MSTORE makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.
            Further, MSTORE does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site. </p>


            <h2>LIMITATIONS </h2>
            <p>In no event shall MSTORE be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on MSTORE`s website, even if MSTORE or a MSTORE authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you. </p>

           <h2> ACCURACY OF MATERIALS </h2>
            <p>The materials appearing on MSTORE`s website could include technical, typographical, or photographic errors. MSTORE does not warrant that any of the materials on its website are 100% accurate, complete or current. MSTORE may make changes to the materials contained on its website at any time without notice. However, MSTORE does not make any commitment to update the materials. </p>

           <h2> PRODUCT & SERVICE DESCRIPTIONS </h2>
            <p> Whilst we try to display the colors of our products accurately on the Website, the actual colors you see will depend on your screen and we cannot guarantee that your screen`s display of any color will accurately reflect the color of the product on delivery. </p>

          <p>  All items are subject to availability. We will inform you as soon as possible if the product(s) or service(s) you have ordered are not available and we may offer an alternative product(s) or service(s) of equal or higher quality and value otherwise the order had to be canceled. </p>

           <h2> ACCEPTANCE OF YOUR ORDER </h2>
           <p> Please note that completion of the online checkout process does not constitute our acceptance of your order. Our acceptance of your order will take place only when we dispatch the product(s) or commencement of the services that you ordered from us. </p>
           
           <p>
            By completing and submitting the electronic order form (or proceeding through the `checkout process`) you are making an offer to purchase goods which, if accepted by us, will result in a binding contract. Neither submitting an electronic order form nor completing the checkout process constitutes our acceptance of your order. </p>

            <p>If you supplied us with your email address when entering your payment details (or if you have a registered account with us), we will notify you by email as soon as possible to confirm that we have received your order. </p>

            <p>All products that you order through the Website will remain the property of MSTORE until we have received payment in full from you for those products. </p>

            <p>If we cannot supply you with the product or service you ordered, we will not process your order. We will inform you via email or call, if you have already paid for the product or service, refund you in full as soon as reasonably possible. </p>

           <p> MSTORE reserved the right to cancel your order in the case of but not limited to; unavailability of product, incorrectly listed price, or any other information. </p>

            <h2>DELIVERY OF YOUR ORDER </h2>
            <p>MSTORE products are sold on a delivery duty unpaid basis. The recipient may have to pay import duty or a formal customs entry fee prior to or on delivery. Additional taxes, fees or levies may apply according to local legislation and customers are required to check these details before placing an order for international delivery. </p>

          <p>We will deliver to the home or office address indicated by you when you place an order.
            We cannot deliver to PO boxes. All deliveries must be signed for upon receipt. We will try at least twice to deliver your order at the address indicated by you.</p>

            <p>We reserve the right to cancel your purchase in the event nobody is available to sign for receipt.
            You bear the risk for the products once delivery is completed.</p>

           <p> Where possible, we try to deliver in one go. We reserve the right to split the delivery of your order, for instance (but not limited to) if part of your order is delayed or unavailable. In the event that we split your order, we will notify you of our intention to do so by sending you an e-mail to the e-mail address provided by you at the time of purchase. You will not be charged for any additional delivery costs.</p>

            <p>We can entertain any changes to order provided if the order isn`t dispatched yet. We will not be able to accept any order change requests once the order is dispatched (neither any refund or exchange will be possible in case of delivery outside Pakistan.) </p>

            <h2>LINKS</h2>
            <p>We may have placed links on this Website to other websites which we think you may want to visit. We do not vet these websites and do not have any control over their contents. Except where required by applicable law, MSTORE cannot accept any liability in respect of the use of these websites.</p>

            <h2>MODIFICATIONS</h2>
            <p>MSTORE may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>

            <h2>GOVERNING LAW</h2>
            <p>These terms and conditions are governed by and construed in accordance with the laws of Pakistan and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>

            <h2>COMPLAINTS PROCESS </h2>
            <p>We hope that you`re pleased with any purchase you`ve made or the service you`ve received from MSTORE and that you`ll never have reason to complain - but if there`s something you`re not happy with, we`d like to put matters right, so please contact us straight away: </p>

            <h2>BY EMAIL </h2>
            <p> eshop@mstore.com </p>

            <h2>BY TELEPHONE </h2>
            <p> 021 111 112 111 (9am - 10pm , Monday - Saturday ) </p>',
            ],
            [
                'title'=>'Frequently Asked Questions',
                'slug'=>'faq',
                'longdetails'=>"
               <h2> HOW DO I PLACE AN ORDER? </h2>
               <p> Ordering at mantra.com.pk is easy. Just select the items you want to shop, enter your shipping address and payment information, and you can place your order. If you need any assistance, give us a call at +92311-1111111 Monday to Saturday. </p>

               <h2> HOW WILL MY ORDER BE DELIVERED TO ME? </h2>
               <p> Your order would be delivered through reputed courier companies at your doorstep. </p>

               <h2> HOW WILL I KNOW IF ORDER IS PLACED SUCCESSFULLY? </h2>
               <p> Once your Order is successfully placed, you will receive a confirmation call, email, and text message from mantra.com.pk. This mail will have all the details related to your order. Order details can also be viewed at My Account -> My Orders if you have placed the order on your own online. </p>

               <h2> DO YOU TAKE ORDERS OVER THE PHONE? </h2>
               <p> Yes, we do take orders over the phone. The payment mode possible for these orders is Cash on Delivery only. </p>

               <h2> I TRIED PLACING ORDER USING MY CREDIT CARD BUT IT ISN'T WORKING. CAN YOU HELP ME PLACE AN ORDER?</h2>

               <p> Yes, if your debit/credit card isn't working, we can always take your order over the phone. Do call us at +92311-1111111. </p>",
            ],
            [
                'title'=>'Shipping Policy',
                'slug'=>'shipping-policy',
                'longdetails'=>"
               <h2>Shipping Policy</h2>
                <p>Thank you for shopping at MSTORE. Below are the terms and conditions 
                that constitute our Shipping Policy.</p>
                
                <h2>Processing Time</h2>
                <p>All orders are processed within [X] business days. Orders are not shipped or delivered on weekends or holidays.</p>
                <p>If we are experiencing a high volume of orders, shipments may be delayed by a few days. Please allow additional days in transit for delivery. If there will be a significant delay in the shipment of your order, we will contact you via email or telephone.</p>
                
                <h2>Shipping Rates & Delivery Estimates</h2>
                <p>Shipping charges for your order will be calculated and displayed at checkout.</p>
                <ul>
                    <li><strong>Standard Shipping</strong>: [estimated delivery time] - [cost]</li>
                    <li><strong>Expedited Shipping</strong>: [estimated delivery time] - [cost]</li>
                    <li><strong>Overnight Shipping</strong>: [estimated delivery time] - [cost]</li>
                </ul>
                <p>Delivery delays can occasionally occur.</p>
                
                <h2>Shipment to P.O. boxes or APO/FPO addresses</h2>
                <p>[Your Company Name] ships to addresses within the U.S., U.S. Territories, and APO/FPO/DPO addresses.</p>
                
                <h2>Shipment Confirmation & Order Tracking</h2>
                <p>You will receive a Shipment Confirmation email once your order has shipped containing your tracking number(s). The tracking number will be active within 24 hours.</p>
                
                <h2>Customs, Duties, and Taxes</h2>
                <p>[Your Company Name] is not responsible for any customs and taxes applied to your order. All fees imposed during or after shipping are the responsibility of the customer (tariffs, taxes, etc.).</p>
                
                <h2>Damages</h2>
                <p>[Your Company Name] is not liable for any products damaged or lost during shipping. If you received your order damaged, please contact the shipment carrier to file a claim.</p>
                <p>Please save all packaging materials and damaged goods before filing a claim.</p>
                
                <h2>International Shipping Policy</h2>
                <p>We currently do not ship outside the U.S. [Or provide details if you do ship internationally]</p>
                
                <h2>Returns Policy</h2>
                <p>Our Return & Refund Policy provides detailed information about options and procedures for returning your order.</p>
    
                ",
            ],
            [
                'title'=>'EXCHANGE AND RETURN POLICY',
                'slug'=>'exchange-and-return-policy',
                'longdetails'=>"
                 <h2>Exchange and Return Policy</h2>
                    <p>At MSTORE, we strive to ensure our customers are completely satisfied with their purchases. If you are not satisfied with your purchase, we are here to help.</p>
                    
                    <h2>Return Eligibility</h2>
                    <p>To be eligible for a return, please make sure that:</p>
                    <ul>
                        <li>The product was purchased in the last [X] days</li>
                        <li>The product is in its original packaging</li>
                        <li>The product isn't used or damaged</li>
                        <li>You have the receipt or proof of purchase</li>
                    </ul>
                    <p>Products that do not meet these criteria will not be considered for return.</p>
                    
                    <h2>Return Process</h2>
                    <p>To initiate a return, please follow these steps:</p>
                    <ul>
                        <li>Contact us by email: [your.email@example.com]</li>
                        <li>Include your order number, product details, and reason for the return</li>
                        <li>We will provide you with instructions on where to send the returned product</li>
                    </ul>
                    
                    <h2>Exchanges</h2>
                    <p>We only replace items if they are defective or damaged. If you need to exchange an item for the same product, please contact us at [your.email@example.com] with the details of the product and the issue.</p>
                    
                    <h2>Refunds</h2>
                    <p>Once we receive your item, we will inspect it and notify you that we have received your returned item. We will immediately notify you of the status of your refund after inspecting the item.</p>
                    <p>If your return is approved, we will initiate a refund to your original method of payment. The time frame for the refund to be processed and posted depends on your card issuer's policies.</p>
                    
                    <h2>Shipping</h2>
                    <p>You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are non-refundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</p>
                    
                    <h2>Contact Us</h2>
                    <p>If you have any questions about our Exchange and Return Policy, please contact us:</p>
                    <p class='contact-info'>
                        [Your Company Name]<br>
                        Email: [your.email@example.com]<br>
                        Phone: [Your Phone Number]<br>
                        Address: [Your Physical Address]
                    </p>
                ",
            ],
            [
                'title'=>'About us',
                'slug'=>'about-us',
                'longdetails'=>"
                <h2>Welcome To MSTORE</h2>
                <p>MSTORE is fully customizable and appearing to your customers in accordance with what 
                they need and what they search Be a star of your own dream.Start your own ecommerce business 
                right now!</p>

                <h2>Our Story</h2>
                <p>MSTORE started when [founder's name or 'we'] realized that [describe the problem you set out to solve]. Since then, we have grown from a small [type of business, e.g., family-run business] to a [describe current state, e.g., thriving e-commerce platform] 
                that serves customers worldwide.</p>

                <h2>Our Mission and Values </h2>
                <p> Our mission is to [your mission statement]. We believe in [core values, e.g., quality, sustainability, customer satisfaction], and these principles guide everything we do.</p>

                <p><b>Quality:</b> We are dedicated to providing products that meet the highest standards.</p>
                <p><b>Sustainability:</b> We prioritize eco-friendly practices and sustainable sourcing.</p>
                <p><b>Customer Satisfaction:</b> Our customers are at the heart of our business, and we strive to exceed their expectations every day.</p>

                <h2>What We Offer</h2>
                <p>[Brief description of your products/services]. Whether you are looking for [example product 1], [example product 2], or [example product 3], we have something for everyone. Our products are [unique selling points, e.g., handcrafted, ethically sourced, made from the finest materials].
                </p>

                <h2>Join Our Community</h2>
                <p>We invite you to join our community of satisfied customers. [Call to action, e.g., Browse our latest collection,Sign up for our newsletter, Follow us on social media]. </p>
                
                <p>Feel free to contact us at [contact information] if you have any questions or need assistance. We are here to help!
                </p>

                ",
            ],
            [
                'title'=>'Privacy Policy',
                'slug'=>'privacy-policy',
                'longdetails'=>"
                 <h2>Privacy Policy</h2>
                <p>Welcome to MSTORE</p>
                <p>We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy, or our practices with regards to your personal information, please contact us at [your.email@example.com].</p>
                <p>When you visit our website [Your Website URL], and use our services, you trust us with your personal information. We take your privacy very seriously. In this privacy policy, we seek to explain to you in the clearest way possible what information we collect, how we use it and what rights you have in relation to it. We hope you take some time to read through it carefully, as it is important. If there are any terms in this privacy policy that you do not agree with, please discontinue use of our Sites and our services.</p>

                <h2>Information We Collect</h2>
                <p>We collect personal information that you voluntarily provide to us when registering at the [Website Name], expressing an interest in obtaining information about us or our products and services, when participating in activities on the [Website Name] (such as posting messages in our online forums or entering competitions, contests or giveaways) or otherwise contacting us.</p>

                <h2>How We Use Your Information</h2>
                <p>We use personal information collected via our [Website Name] for a variety of business purposes described below. We process your personal information for these purposes in reliance on our legitimate business interests, in order to enter into or perform a contract with you, with your consent, and/or for compliance with our legal obligations. We indicate the specific processing grounds we rely on next to each purpose listed below.</p>
                <ul>
                    <li>To facilitate account creation and logon process.</li>
                    <li>To send administrative information to you.</li>
                    <li>To fulfill and manage your orders.</li>
                    <li>To post testimonials.</li>
                    <li>Request Feedback.</li>
                    <li>To protect our Services.</li>
                    <li>To enforce our terms, conditions and policies.</li>
                    <li>To respond to legal requests and prevent harm.</li>
                    <li>To manage user accounts.</li>
                    <li>To deliver services to the user.</li>
                    <li>To respond to user inquiries/offer support to users.</li>
                </ul>

                <h2>Sharing Your Information</h2>
                <p>We only share and disclose your information in the following situations:</p>
                <ul>
                    <li>Compliance with Laws.</li>
                    <li>Vital Interests and Legal Rights.</li>
                    <li>Vendors, Consultants and Other Third-Party Service Providers.</li>
                    <li>Business Transfers.</li>
                    <li>Affiliates.</li>
                    <li>Business Partners.</li>
                    <li>With your Consent.</li>
                    <li>Other Users.</li>
                </ul>

                <h2>Cookies and Other Tracking Technologies</h2>
                <p>We may use cookies and similar tracking technologies (like web beacons and pixels) to access or store information. Specific information about how we use such technologies and how you can refuse certain cookies is set out in our Cookie Policy.</p>

                <h2>Data Retention</h2>
                <p>We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy policy, unless a longer retention period is required or permitted by law (such as tax, accounting or other legal requirements).</p>

                <h2>Data Protection Rights</h2>
                <p>You have certain rights under data protection laws in relation to your personal data. These include the right to:</p>
                <ul>
                    <li>Request access to your personal data.</li>
                    <li>Request correction of your personal data.</li>
                    <li>Request erasure of your personal data.</li>
                    <li>Object to processing of your personal data.</li>
                    <li>Request restriction of processing your personal data.</li>
                    <li>Request transfer of your personal data.</li>
                    <li>Right to withdraw consent.</li>
                </ul>

                <h2>Contact Us</h2>
                <p>If you have questions or comments about this policy, you may contact our Data Protection Officer (DPO), by email at [your.email@example.com], or by post to:</p>
                <p>[Your Company Name]<br>
                [Street Address]<br>
                [City, State, Zip Code]<br>
                [Country]</p>

                <h2>Changes to This Privacy Policy</h2>
                <p>We may update this privacy policy from time to time in order to reflect, for example, changes to our practices or for other operational, legal or regulatory reasons.</p>",
            ],
        ];
        foreach($pagesData as $data){
            Page::create([
                'title'=>$data['title'],
                'slug'=>$data['slug'],
                'longdetails'=>$data['longdetails'],
                'shortdetails'=>' ',

            ]);
        }
    }
}
