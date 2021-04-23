<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : local
 * Product Name : PhpStorm
 * Date         : 11-11-15 4:07 PM
 * File Name    : Reository.php
 */

namespace App\Repository\Eloquent;
use Auth;
use App\Classes\UrlFilter;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use App\User;


class Repository {

	protected $data;
	protected $user_id;


	public function __construct(  ) {

		@$this->data->user ='' ;
		$this->is_api = UrlFilter::filter();
	}
}
