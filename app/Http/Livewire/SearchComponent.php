<?php

namespace App\Http\Livewire;


use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;


class SearchComponent extends Component
{use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pageSize = 12, $orderBy = "Default", $q, $search_term, $min_value = 0, $max_value = 1000;

    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q.'%';
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item added to cart!');
        return redirect()->route('shop.cart');
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }
    public function render()
    {
        switch ($this->orderBy)
        {
            case 'Price: Low to High':
            {
                $products = Product::where('name', 'like', $this->search_term)->whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
                break;
            }
            case 'Price: High to Low':
            {
                $products = Product::where('name', 'like', $this->search_term)->whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
                break;
            }
            case 'Release Date':
            {
                $products = Product::where('name', 'like', $this->search_term)->whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            }

            default:
            {
                $products = Product::where('name', 'like', $this->search_term)->whereBetween('regular_price', [$this->min_value, $this->max_value])->paginate($this->pageSize);
                break;
            }
        }


        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.search-component', ['products' => $products, 'categories' => $categories, 'min_value' => $this->min_value, 'max_value' => $this->max_value]);
    }
}
