<?php

namespace App\Http\Controllers;

use App\Repository\Eloquent\CronRepository;
use Illuminate\Http\Request;

class CronController extends Controller
{
    /**
     * @var \App\Repository\Eloquent\CronRepository
     */
    private $cron;
    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * CronController constructor.
     *
     * @param \App\Repository\Eloquent\CronRepository $cron
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(CronRepository $cron, Request $request) {
        parent::__construct();
        $this->cron    = $cron;
        $this->request = $request;
    }

    public function checkProducts() {
        $products = $this->cron->checkProducts();
        if(!empty($products)) {
            foreach ($products as $product) {
                //echo '<tt><pre>'; print_r($product); die;
                $this->cron->sendAlertEmail($product);
                foreach ($product as $item) {
                    $this->cron->updateEmailAlertCount($item[ 'id' ]);
                }
            }
        }
    }
}
