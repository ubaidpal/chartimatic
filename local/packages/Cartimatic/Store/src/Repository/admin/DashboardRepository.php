<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 28-Sep-16 11:20 AM
 * File Name    : DashboardController.php
 */

namespace Cartimatic\Store\Repository\admin;

use Carbon\Carbon;
use Cartimatic\Store\StoreOrder;

class DashboardRepository
{

    public function getData($user_id) {
        $tomorrow     = Carbon::tomorrow()->toDateString();
        $today     = Carbon::today()->toDateString();
        $lastMonth = Carbon::tomorrow()->subDays(29)->toDateString();

        $today_revenue = $this->getRevenue($user_id, $today);
        $month_revenue = $this->getRevenue($user_id, $tomorrow, $lastMonth);

        $data[ 'today_revenue' ] = $today_revenue[ 'today_revenue' ];
        $data[ 'today_orders' ]  = $today_revenue[ 'today_orders' ];

        $data[ 'month_revenue' ] = $month_revenue[ 'month_revenue' ];
        $data[ 'month_orders' ]  = $month_revenue[ 'month_orders' ];

        $data[ 'today_profit' ] = $this->getProfit($user_id, $today, NULL, $data[ 'today_revenue' ]);
        $data[ 'month_profit' ] = $this->getProfit($user_id, $tomorrow, $lastMonth, $data[ 'month_revenue' ]);

        $data[ 'today_profit' ] = $this->getProfit($user_id, $today, NULL, $data[ 'today_revenue' ]);
        $data[ 'month_profit' ] = $this->getProfit($user_id, $tomorrow, $lastMonth, $data[ 'month_revenue' ]);
        return $data;
    }

    private function getRevenue($user_id, $endDate, $startDate = NULL) {

        if(is_null($startDate)) {
            return StoreOrder::whereSellerId($user_id)->whereDate('created_at', '=', $endDate)->select(\DB::raw('SUM(total_price) - SUM(total_shiping_cost) as today_revenue, COUNT(id) as today_orders'))->first()->toArray();
        } else {
            return StoreOrder::whereSellerId($user_id)->whereBetween('created_at', [$startDate, $endDate])->select(\DB::raw('SUM(total_price) - SUM(total_shiping_cost) as month_revenue, COUNT(id) as month_orders'))->first()->toArray();
        }
    }

    private function getProfit($user_id, $endDate, $startDate = NULL, $revenue) {

        $data = StoreOrder::whereSellerId($user_id)->with('orderItems.StoreProductKeeping');
        if(is_null($startDate)) {
            $data->whereDate('created_at', '=', $endDate);
        } else {
            $data->whereBetween('created_at', [$startDate, $endDate]);
        }
        $data = $data->get()->toArray();

        $cost = $this->getCostTotal($data);
        return $revenue - $cost;
    }

    private function getCostTotal($data) {
        $sum = 0;
        foreach ($data as $item) {
            if(!empty($item[ 'order_items' ])) {
                foreach ($item[ 'order_items' ] as $order_item) {
                    $sum = $sum + $order_item[ 'store_product_keeping' ][ 'cost_price' ];
                }
            }
        }
        return $sum;

    }
}
