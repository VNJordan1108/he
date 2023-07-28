<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $pageSize = 12, $orderBy = "Default", $slug, $min_value = 0, $max_value = 1000;

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


    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function render()
    {
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        switch ($this->orderBy)
        {
            case 'Price: Low to High':
            {
                $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
                break;
            }
            case 'Price: High to Low':
            {
                $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
                break;
            }
            case 'Release Date':
            {
                $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->min_value, $this->max_value])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            }

            default:
            {
                $products = Product::where('category_id', $category_id)->whereBetween('regular_price', [$this->min_value, $this->max_value])->paginate($this->pageSize);
                break;
            }
        }


        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.category-component', ['products' => $products, 'categories' => $categories, 'category_name' => $category_name, 'min_value' => $this->min_value, 'max_value' => $this->max_value]);
    }
}
