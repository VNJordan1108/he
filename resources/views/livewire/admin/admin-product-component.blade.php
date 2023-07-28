<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home.index')}}" rel="nofollow">Home</a>
                    <span></span> All Products
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="d-flex align-self-center">All Products</div>
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('admin.product.add')}}" class="btn btn-success float-end">Add New Product</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('success'))

                                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>

                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Categories</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                @php
                                    $i = ($products->currentPage()-1)*$products->perPage();
                                @endphp
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td><img src="{{asset('assets/imgs/shop/product-')}}{{$product->id}}-1.jpg" alt="{{$product->name}}" title="{{$product->name}}" width=60></td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->stock_status}}</td>
                                            <td>{{$product->regular_price}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->created_at}}</td>
                                            <td>
                                                {{-- <a href="{{route('admin.product.edit', ['product_id' => $product->id])}}"><i class="fa-regular fa-pen-to-square"></i></a> --}}
                                                {{-- <a href="#" class="text-danger" style="margin-left:20px;" onclick="deleteConfirmation({{$category->id}})"><i class="fa-solid fa-trash-can"></i></a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                                {{$products->links('pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Do you want to delete this record</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--
@push('scripts')
    <script>
        function deleteConfirmation(id)
        {
            @this.set('category_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory()
        {
            @this.call('deleteProduct');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush --}}

<script src="https://kit.fontawesome.com/eab57e94b4.js" crossorigin="anonymous"></script>
