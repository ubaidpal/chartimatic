@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="col-md-9 pro-header">
			<h1>Messages</h1>
        </div>
        <div class="col-md-3">
        	<div class="row">
            	<a class="continue-link" href="http://localhost/shalmi/pages/category_products">Back to messages &nbsp; &gt;</a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="row">
    	<div class="col-md-3">
        	<div class="row">
            	<div class="cart-left-nav">
                	<nav>
                        <ul class="nav">
                            <li><a href="#" class="active">All Orders</a></li>
                            <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">Shipping Address (toggle)</a>
                                <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                                    <li><a href="#">Link 2.1</a></li>
                                    <li><a href="#">Link 2.2</a></li>
                                    <li><a href="#">Link 2.3</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Manage Feedbacks</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Invoices</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
        	<div class="row">
            	<div class="order-link-wrapper">
                	<div class="name-box">Roman Nemdus</div>
                </div>
                
                <div class="messages-wrapper">
                	<div class="msg-detial-box">
                		<div class="user-messages">
                            <div class="col-md-2">
                                <div class="user-name">Roman Nemdus</div>
                                <div class="msg-date">Apr 19 | 05:54 pm</div>
                            </div>
                            <div class="col-md-8">
                                <div class="text-message">
                                    Nanti kita technical meeting lomba jogja...
                                </div>
                            </div>
                            <div class="col-md-2">&nbsp;</div>
                        </div>
                    	
                        <div class="my-messages">
                            <div class="col-md-2">&nbsp;</div>
                            <div class="col-md-8">
                                <div class="text-message">
                                    Nanti kita technical meeting lomba jogja al meeting lomba al meeting lomba ...
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="user-name">Me</div>
                                <div class="msg-date">Apr 19 | 05:54 pm</div>
                            </div>
                        </div>
                        
                        <div class="user-messages">
                            <div class="col-md-2">
                                <div class="user-name">Roman Nemdus</div>
                                <div class="msg-date">Apr 19 | 05:54 pm</div>
                            </div>
                            <div class="col-md-8">
                                <div class="text-message">
                                    Nanti kita technical meeting  lomba jogja al meeting lomba lomba jogja...
                                </div>
                            </div>
                            <div class="col-md-2">&nbsp;</div>
                        </div>
                    	
                        <div class="my-messages">
                            <div class="col-md-2">&nbsp;</div>
                            <div class="col-md-8">
                                <div class="text-message">
                                    Nanti kita technical meeting al meeting lomba ...
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="user-name">Me</div>
                                <div class="msg-date">Apr 19 | 05:54 pm</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="write-msg-box">
                    	<div class="col-md-10">
                        	<textarea placeholder="Type your message ..." rows="1"></textarea>
                        </div>
                        <div class="col-md-2">
                            <a class="send-msg" href="#">send</a>
                            <a class="attachment" href="#">attach</a>
                        </div>
                    </div>
                </div>                
                <div class="pagination-wrapper">
                	<div class="pages-limit">
                    	<div class="input-group">
                        	<label>Show</label>
                            <select class="form-control">
                              <option>25</option>
                              <option>50</option>
                              <option>100</option>
                            </select>
                            <label>per page</label>
                        </div>
                    </div>
                    
                    <div class="pagination-box">
                    	<ul class="pagination"> <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li> <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li> <li><a href="#">2</a></li> <li><a href="#">3</a></li> <li><a href="#">4</a></li> <li><a href="#">5</a></li> <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li> </ul>
                    </div>
                </div>
            </div>	
        </div>
    </div>
</div>
@endsection
