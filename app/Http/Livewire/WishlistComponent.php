<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class WishlistComponent extends Component
{

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem)
            {
                if ($witem->id == $product_id)
                {
                    Cart::instance('wishlist')->remove($witem->rowId);
                    $this->emitTo('wishlist-icon-component', 'refreshComponent');
                    return;
                }
            }
    }

    public function render()
    {
        return view('livewire.wishlist-component');
    }
}
