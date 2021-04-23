@extends('layouts.dashboard')

@section('content')

<!-- Cartimatic Header html-->
<div class="top-bg">
	@include('includes.header-dashboard')	
	
    <div class="container">
    	<div class="search-areas">
        	<h2>Easily sell in store</h2>
            <p>Cartimatic’s POS system will help you grow your retail business.</p>
            <div class="input-group get-started">
              <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
              <span class="input-group-addon" id="">Get Started</span>
            </div>
            <div class="free-trail">Try Cartimatic free for 14 days. No risk, and no credit card required.</div>
        </div>
    </div>
</div>

<div class="container nopadding">
	<div class="pos-img-wrapper">
    	<img src="{!! asset('local/public/assets/bootstrap/images/pos-hardware.png') !!}" />
   	</div>
	<div class="feature-text-wrapper">
    	<h2>Sell more to your customers, in-store and online.</h2>
        <p>Here are some points to consider when choosing the right POS system:</p>
		<span class="sep-line"></span>
    </div>
</div>



<div class="container nopadding">
	<div class="row features-box">
    	<div class="col-md-4 f-single">
        	<div class="icon productorganization"></div>
            <div class="f-head">Product organization</div>
            <p class="f-text">Organize products by category, type, season, sale, and more. Use smart collections to automatically sort products based on vendor, price, and inventory level.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon accountintegrate"></div>
            <div class="f-head">Accounting integration</div>
            <p class="f-text">Save time and money on bookkeeping by integrating Cartimatic.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon insightsanalytics"></div>
            <div class="f-head">Insights and analytics</div>
            <p class="f-text">Compare and study detailed sales reports, and discover your products from the most popular to the best-selling.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon sync"></div>
            <div class="f-head">Synchronize</div>
            <p class="f-text">Sync your customer information with Cartimatic so as to view all order history irrespective of where the order was placed.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon barcodesupport"></div>
            <div class="f-head">Barcode support</div>
            <p class="f-text">Fast scan barcodes of the products ordered by your customer’s via barcode scanner or assign new barcodes to new products.</p>
        </div>
        <div class="col-md-4 f-single">
        	<div class="icon staff"></div>
            <div class="f-head">Staff management</div>
            <p class="f-text">Manage your staff by assigning individual staff passwords and easily track all register activity and orders through staff accounts.</p>
        </div>
    </div>    
</div>

<div class="pos-software">
	<div class="text-wrap">
    	<h1>Run the world’s best retail with Cartimatic POS software.</h1>
        <p> Cartimatic is retail POS software, inventory management, ecommerce & customer loyalty for iPad, Mac and PC.<br/>
Easily manage & grow your business in the cloud.</p>
    </div>
</div>

<div class="container nopadding">
	<div class="feature-text-wrapper">
    	<h2>Everything you need to run your retail business.</h2>
        <p>Here are some points to consider when choosing the right POS system:</p>
		<span class="sep-line"></span>
    </div>
    
    <div class="sub-navigaion">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">sell</a></li>
            <li><a data-toggle="tab" href="#menu1">manage</a></li>
            <li><a data-toggle="tab" href="#menu2">report</a></li>
        </ul>
        
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <div class="col-md-12 nopadding featured-wrapper">
    	<div class="col-md-4 nopadding">
        	<div class="featured-box point">
            	<h4>POS</h4>
                <p>Cartimatic allows you to sell to your customers with extreme ease, whether you are using our responsive web-based POS or Cartimatic desktop application.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box ecommerce">
            	<h4>Cartimatic Ecommerce</h4>
                <p>You can build a beautiful online store in minutes and quickly add products and start fulfilling orders.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box soperation">
            	<h4>Sales operations</h4>
                <p>Make shopping a pleasant experience for your customers with features like easy returns, refunds, and email receipts.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box gift">
            	<h4>Vouchers and gift cards</h4>
                <p>A lot redeemable vouchers and gift cards which can be emailed to customers or print them via receipt printer.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box hardware">
            	<h4>Hardware</h4>
                <p>Cartimatic POS hardware includes barcode scanner and receipt printer that places convenience on the palm of your hand.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box works">
            	<h4>Work offline</h4>
                <p>Cartimatic POS allows you to carry out your operation with interruption even when there is no active internet connection. Your database will be updated and linked to the main network once the internet is back on.</p>
            </div>
        </div>
    </div>
            </div>
            <div id="menu1" class="tab-pane fade">
              <div class="col-md-12 nopadding featured-wrapper">
    	<div class="col-md-4 nopadding">
        	<div class="featured-box point">
            	<h4>Refunds</h4>
                <p>You can refund past order in the form of gift cards, store credit or back to the customer using the original payment method.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box ecommerce">
            	<h4>Order history</h4>
                <p>All past orders made in store or online can be searched and viewed by customer name, product or date.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box soperation">
            	<h4>Cash Float</h4>
                <p>Individual staff passwords allow you easier tracking of register usage and staff’s sales to manage cash float.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box gift">
            	<h4>Daily total</h4>
                <p>Cartimatic allows you to keep a check and track all daily totals of all sorts of payment.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box hardware">
            	<h4>Accounting integration</h4>
                <p>Integration with QuickBooks saves time and money on bookkeeping.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box works">
            	<h4>Staff Accounts</h4>
                <p>Create multiple staff accounts and secure them with a pin code</p>
            </div>
        </div>
    </div>
            </div>
            <div id="menu2" class="tab-pane fade">
              <div class="col-md-12 nopadding featured-wrapper">
    	<div class="col-md-4 nopadding">
        	<div class="featured-box point">
            	<h4>Dashboard</h4>
                <p>A dashboard showing all your sales, orders and traffic allows you to make the right choices for your business at the right time.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box ecommerce">
            	<h4>Retail reports</h4>
                <p>Sales reports to help you analyze sale by location, staff members and time period.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box soperation">
            	<h4>Product reports</h4>
                <p>Analyzing which product is selling and which on is not brings you invaluable knowledge about the growth of your store.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box gift">
            	<h4>Export reports</h4>
                <p>Export your reports to your account or further analyze them in a spreadsheet tool of your choice.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box hardware">
            	<h4>Sale repots</h4>
                <p>Detailed sales reports showing all sales along with the product, time of sale, place of sale and the staff member who made the sale to a particular customer.</p>
            </div>
        </div>
        <div class="col-md-4 nopadding">
        	<div class="featured-box works">
            	<h4>Inventory Reports</h4>
                <p>Reports about the current and past status of the inventory.</p>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>    
</div>

<div class="three-images-wrapper">
	<div class="col-md-12 nopadding">
    	<div class="row">
        	<div class="col-md-4"><img src="{!! asset('local/public/assets/bootstrap/images/img-1.png') !!}" /></div>
            <div class="col-md-4"><img src="{!! asset('local/public/assets/bootstrap/images/img-2.png') !!}" /></div>
            <div class="col-md-4"><img src="{!! asset('local/public/assets/bootstrap/images/img-3.png') !!}" /></div>
        </div>
    	
    </div>
</div>


<div class="b-email">
	<div class="container nopadding">
    	<div class="feature-text-wrapper">
            <h2>The perfect POS software solution for multi-store retailers.</h2>
            <p>Easily manage and grow your business with Vend, no matter how complex your operations are.</p>
            <span class="sep-line"></span>
        </div>
    </div>
    <div class="">
		<div class="input-group get-started">
          <input type="text" class="form-control" placeholder="Enter your business email" aria-describedby="basic-addon2">
          <span class="input-group-addon" id="">Get Started</span>
        </div>
	</div>
</div>
<div class="clrfix"></div>
@endsection
