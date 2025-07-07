<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagment
{
    //add item to cart
    static public function addItemToCart($product_id)
    {
        $cart_items = self::getAllCartItemsFromCookie();

        $existing_item = collect($cart_items)->search(fn($item) => $item['product_id'] == $product_id);

        if ($existing_item !== false) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::select('id', 'name', 'price', 'images')->find($product_id);

            if ($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0] ?? null,
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }
    //add item to cart with qty
    static public function addItemToCartWithQty($product_id, $product_qty)
    {
        $cart_items = self::getAllCartItemsFromCookie();

        $existing_item = collect($cart_items)->search(fn($item) => $item['product_id'] == $product_id);

        if ($existing_item !== false) {
            $cart_items[$existing_item]['quantity'] = $product_qty;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['unit_amount'] * $cart_items[$existing_item]['quantity'];
        } else {
            $product = Product::select('id', 'name', 'price', 'images')->find($product_id);

            if ($product) {
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->images[0] ?? null,
                    'quantity' => $product_qty,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price * $product_qty,
                ];
            }
        }

        self::addCartItemsToCookie($cart_items);
        return count($cart_items);
    }
    //remove item from cart
    static public function removefromCart($product_id)
    {
        $cart_items = self::getAllCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
                self::addCartItemsToCookie($cart_items);
            }
        }

        return $cart_items;
    }

    //add cart items to cookie
    static public function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }
    //clear cart items from cookie
    static public function clearCartItemFromCookie()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }
    //get all cart items from cookie
    static public function getAllCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);

        if (!$cart_items) {
            $cart_items = [];
        }

        return $cart_items;
    }

    // increment item quantity
    static public function incrementCartItemQuantity($product_id)
    {
        $cart_items = self::getAllCartItemsFromCookie();

        foreach ($cart_items as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity']++;
                $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }
    // decrement item quantity
    static public function decrementCartItemQuantity($product_id)
    {
        $cart_items = self::getAllCartItemsFromCookie();

        foreach ($cart_items as &$item) {
            if ($item['product_id'] == $product_id) {

                if ($item['quantity'] > 1) {
                    $item['quantity']--;
                    $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
                }
                break;
            }
        }

        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }
    // calculate grand total
    static public function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }

}
