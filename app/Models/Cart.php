<?php

namespace App\Models;

use Session;
class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldcart)
    {
        if($oldcart){
            $this->items = $oldcart->items;
            $this->totalQty = $oldcart->totalQty;
            $this->totalPrice = $oldcart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storeItem['qty'] = 0; //added later to test
        $storeItem = ['qty'=>0, 'price'=>$item->price, 'item'=>$item];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storeItem = $this->items[$id];
            }
        }
        $storeItem['qty'] = $storeItem['qty']+$item->qty;
        $sumprice = $item->price*$storeItem['qty'];
        $newprice = number_format((float)$sumprice, 2, '.', '');
        $storeItem['price'] = $newprice;
        $this->items[$id] = $storeItem;
        $this->totalQty++;
        $this->totalPrice += $storeItem['price'];
    }

    public function removeItem($id){
        $this->totalQty --;
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
