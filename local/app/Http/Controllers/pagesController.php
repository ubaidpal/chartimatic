<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller\View;

class pagesController extends Controller
{

	public function index()
    {
       return view('pages.index');
    }
	public function category()
    {
       return view('pages.category');
    }
	public function signin()
    {
       return view('pages.signin');
    }
	public function signup()
    {
       return view('pages.signup');
    }
	public function category_products()
    {
       return view('pages.category_products');
    }
	
	public function brand_index()
    {
       return view('pages.brand_index');
    }
	public function product_detail()
    {
       return view('pages.product_detail');
    }
	public function cartimatic_cart()
    {
       return view('pages.cartimatic_cart');
    }
	
	public function cartimatic_checkout()
    {
       return view('pages.cartimatic_checkout');
    }
	
	public function cartimatic_payment()
    {
       return view('pages.cartimatic_payment');
    }
	
	public function admin_index()
    {
       return view('pages.admin_index');
    }
	
	public function manage_orders()
    {
       return view('pages.manage_orders');
    }
	
	public function wishlist()
    {
       return view('pages.wishlist');
    }
	
	public function order_detail()
    {
       return view('pages.order_detail');
    }
	
	public function open_dispute()
    {
       return view('pages.open_dispute');
    }
	
	public function dispute_detail()
    {
       return view('pages.dispute_detail');
    }
	
	public function submit_dispute()
    {
       return view('pages.submit_dispute');
    }
	
	public function messages()
    {
       return view('pages.messages');
    }
	public function messages_detail()
    {
       return view('pages.messages_detail');
    }
	
	public function manage_feedback()
    {
       return view('pages.manage_feedback');
    }
	public function shipping_address()
    {
       return view('pages.shipping_address');
    }
	
	public function my_profile()
    {
       return view('pages.my_profile');
    }
	public function my_profile_edit()
    {
       return view('pages.my_profile_edit');
    }
	public function posLogin()
    {
       return view('pages.posLogin');
    }
	
	public function dashboard()
    {
       return view('pages.dashboard');
    }
	
	public function pos()
    {
       return view('pages.pos');
    }
	public function online_store()
    {
       return view('pages.online_store');
    }
    public function saleChannels()
    {
       return view('pages.admin.saleChannels');
    }
    public function bankTransfer()
    {
        return view('pages.admin.bankTransfer');
    }
    public function subscribtionPlan()
    {
        return view('pages.admin.subscribtionPlan');
    }
    public function pickSubscribtionPlan()
    {
        return view('pages.admin.pickSubscribtionPlan');
    }
    public function generalStoreDetail()
    {
        return view('pages.admin.generalStoreDetail');
    }
	
	public function help_centre()
    {
       return view('pages.help_centre');
    }
	
	public function pricing()
    {
       return view('pages.pricing');
    }

    public function help_centre_pos()
    {
        return view('pages.help_centre_pos');
    }

    public function marketplace()
    {
       return view('pages.marketplace');
    }
	
	
	
}
?>
