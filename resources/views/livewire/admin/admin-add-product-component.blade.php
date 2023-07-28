

@push('styles')

    <style>
        select {
            /* Reset Select */
            appearance: none;
            outline: 10px red;
            border: 0;
            box-shadow: none;
            /* Personalize */
            flex: 1;
            padding: 0 1em;
            color: #fff;
            background-color: #2c3e50;
            background-image: none;
            cursor: pointer;
            border-radius: 2px;
        }
        /* Remove IE arrow */
        select::-ms-expand {
            display: none;
        }

        select option
        {
            background-color: inherit;
        }

        /* Custom Select wrapper */
        .select {
            position: relative;
            display: flex;
            width: 20em;
            height: 3em;
            border-radius: .25em;
            overflow: hidden;
        }
        /* Arrow */
        .select::after {
            content: '\25BC';
            position: absolute;
            top: 0;
            right: 0;
            padding: 1em;
            background-color: #34495e;
            transition: .25s all ease;
            pointer-events: none;
        }
        /* Transition */
        .select:hover::after {
            color: #f39c12;
        }

    </style>

@endpush



<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home.index')}}" rel="nofollow">Home</a>
                    <span></span> Add New Product
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Add New Product
                                </div>

                                <div class="col-md-6">
                                    <a href="{{route('admin.products')}}" class="btn btn-success float-end">All categories</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                            @endif
                            <form wire:submit.prevent = "addProduct">
                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter product name" wire:model="name" wire:keyup = "generateSlug"/>
                                    @error ('name')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Enter product slug" wire:model="slug"/>
                                    @error ('slug')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" placeholder="Enter short description" wire:model="short_description"></textarea>
                                    @error ('short_description')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Enter description" wire:model="description"></textarea>
                                    @error ('description')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="regular_price" class="form-label">Regular Price</label>
                                    <input type="text" name="regular_price" class="form-control" placeholder="Enter product regular price" wire:model="regular_price"/>
                                    @error ('regular_price')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>


                                <div class="mb-3 mt-3">
                                    <label for="sale_price" class="form-label">Sale Price</label>
                                    <input type="text" name="sale_price" class="form-control" placeholder="Enter product sale price" wire:model="sale_price"/>
                                    @error ('sale_price')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control" placeholder="Enter product's SKU" wire:model="sku"/>
                                    @error ('sku')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>


                                <div class="mb-3 mt-3">
                                    <label for="stock_status" class="form-label">Stock status</label>
                                    <div class="select">
                                        <select name="stock_status" id="stock_status">
                                            <option value="instock">In stock</option>
                                            <option value="outofstock">Out of stock</option>
                                        </select>
                                    </div>
                                    @error ('stock_status')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="category_id">Category</label>
                                    <div class="select">
                                        <select name="category_id" id="category_id">
                                            <option value="">- Select category -</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary float-end">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
