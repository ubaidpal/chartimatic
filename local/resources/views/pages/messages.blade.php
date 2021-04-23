@extends('layouts.default')

@section('content')
<div class="col-md-12">
	<div class="row">
    	<div class="col-md-9 pro-header">
			<h1>Messages</h1>
        </div>
        <div class="col-md-3">
        	<div class="row">
            	<form role="search" class="navbar-form p0">
                    <div class="input-group add-on">
                      <input type="text" id="srch-term" name="srch-term" placeholder="Search messages" class="form-control">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                      </div>
                    </div>
                  </form>
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
                	<a href="#">All</a>
                    <a href="#">Unread</a>
                    <a href="#">Read</a>
                    <a href="#">Sent</a>
                </div>
                
                <div class="messages-wrapper">
                	<div class="messages-list unread">
                        	<div class="col-md-1">
                            <a href="#" class="msg-icon">sa f</a>
                        </div>
                        	<div class="col-md-9">
                            	<div class="row">
                                    <div class="msg-title">Dennis Mugo</div>
                                    <div class="msg-desc">
                                        Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...
                                    </div>
                                </div>
                            </div>
                        	<div class="col-md-2">
                    	<div class="date">10 May 2016</div>
                    </div>
                    	</div>
                        
                    <div class="messages-list unread">
                        <div class="col-md-1">
                        <a href="#" class="msg-icon">sa f</a>
                    </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="msg-title">Dennis Mugo</div>
                                <div class="msg-desc">
                                    Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                    <div class="date">10 May 2016</div>
                </div>
                    </div>
                    
                    <div class="messages-list">
                        <div class="col-md-1">
                        <a href="#" class="msg-icon">sa f</a>
                    </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="msg-title">Dennis Mugo</div>
                                <div class="msg-desc">
                                    Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                    <div class="date">10 May 2016</div>
                </div>
                    </div>
                    
                    <div class="messages-list">
                        <div class="col-md-1">
                        <a href="#" class="msg-icon">sa f</a>
                    </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="msg-title">Dennis Mugo</div>
                                <div class="msg-desc">
                                    Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                    <div class="date">10 May 2016</div>
                </div>
                    </div>
                    
                    <div class="messages-list">
                        <div class="col-md-1">
                        <a href="#" class="msg-icon">sa f</a>
                    </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="msg-title">Dennis Mugo</div>
                                <div class="msg-desc">
                                    Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                    <div class="date">10 May 2016</div>
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
