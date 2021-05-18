@extends('master')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('products.index')}}">
                {{ __('welcome.Home') }}
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            {{ __('welcome.Products') }}
        </li>
    </ol>
</nav>

<div class="tableblock p-4">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex align-items-center pb-3">
                <h2>
                    {{ __('welcome.Apply Filter') }}
                </h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>
                            {{ __('welcome.Order By') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="sortby" id="sortby" class="form-control">
                                <option value="">
                                    -{{ __('welcome.Sort products by') }}-</option>
                                <option value="title">{{ __('welcome.Name') }}</option>
                                <option value="stock">{{ __('welcome.Stock') }}</option>
                                <option value="price">{{ __('welcome.Price') }}</option>
                                <option value="rating">{{ __('welcome.Rating') }}</option>
                                <option value="likes">{{ __('welcome.Likes') }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="">
                        <td>
                            <select name="sorttype" id="sorttype" class="form-control mt-2">
                                <option value="asc">{{ __('welcome.Ascending order') }}</option>
                                <option value="desc">{{ __('welcome.Descending order') }}</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
                </tr>
            </table>
            <table class="mt-2">
                <thead>
                    <tr>
                        <th>{{ __('welcome.Categories') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $key=>$category)
                    <tr>
                        <td>
                            <input type="checkbox" class="categories" name="categories[]" id="category-{{ ++$key }}" value="{{ $category->id }}">
                            {{ $category->name }}
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
                </tr>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>
                            <label for="price-max">{{ __('welcome.Price') }}:</label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div data-role="rangeslider">
                                <input type="range" class="slider" name="price" id="price" value="{{  floor($products->avg('price')) }}" min="{{ floor($products->min('price'))  }}" max="{{ floor($products->max('price')) }}">
                                <label id="output"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </tr>
            </table>

            <table>
                <thead>
                    <tr>
                        <th>
                            <label for="rating">{{ __('welcome.Rating') }}:</label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <label class="fa fa-star fa-2x rating" id="rating_1"></label>
                            <label class="fa fa-star fa-2x rating" id="rating_2"></label>
                            <label class="fa fa-star fa-2x rating" id="rating_3"></label>
                            <label class="fa fa-star fa-2x rating" id="rating_4"></label>
                            <label class="fa fa-star fa-2x rating" id="rating_5"></label>

                            <input type="hidden" name="rating" id="rating" value="1">
                        </td>
                    </tr>
                </tbody>
                </tr>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>
                            <label for="stock">{{ __('welcome.Include') }}:</label>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="radio" class="radio" name="stock" value="1" checked>
                            {{ __('welcome.in stock') }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="radio" class="radio" name="stock" value="0">
                            {{ __('welcome.out of stock') }}
                        </td>
                    </tr>
                </tbody>
                </tr>
            </table>
        </div>
        <div class="col-sm-9" id="myProducts">
            <div class="d-flex align-items-center">
                <h2>
                    {{ __('welcome.All The Products') }}
                </h2>
            </div>
            <div class="row" id="products">
                @forelse($products as $key=>$product)
                <div class="col-sm-4 pt-4">
                    <div class="card" style="width: 14rem;">
                        <a href="{{route('products.show', $product->id)}}" style="text-decoration: none;">
                            <img class="card-img-top" src="{{  $product->custom_image }}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title" title="Click here to details.">
                                <a href="{{route('products.show', $product->id)}}" style="text-decoration: none;">
                                    {{ $product->title }}
                                </a>
                            </h5>
                            <small>
                                {{ $product->custom_price }}
                            </small>
                            <p class="card-text">
                                {{ $product->custom_description }}
                            </p>

                            @auth()
                            <span href="javscript:void(0);" onclick='removeProduct("{{ $product->id }}");' class="fa fa-trash trash" title="Do you want to remove this product?"></span>
                            <form action="{{  route('products.destroy', $product->id) }}" method="POST" id="product-form-{{ $product->id }}" style='display:none;'>
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>
                                </button>
                            </form>
                            @endauth

                            <span class="fa fa-thumbs-up float-right isLiked" id="like-span-{{ $product->id }}" productid="{{ $product->id }}" title=" Do you like this product?">
                                <small id="like-{{ $product->id }}">
                                    {{ $product->likes }}
                                </small>
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </div>
            <hr>
            <div class="d-flex justify-content-center float-right">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('add-script')
<script>
    $('.isLiked').click(function() {
        var pid = $(this).attr("productid");

        var _url = "{{ url('products/like') }}/" + pid;
        var _method = 'GET';
        var _data = {};

        $.ajax({
            url: _url,
            type: _method,
            data: _data,
            success: function(response) {
                $('#like-' + pid).html(response);
                $('#like-span-' + pid).css('color', '#2DB1FF');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                // location.reload();
            }
        });
    });

    function removeProduct(product_id) {
        if (confirm('Are you sure you want to remove this product?')) {
            $('#product-form-' + product_id).submit();
        }
    }
</script>
<script>
    $('.rating').click(function() {
        var idName = this.id;
        var rate = idName.match(/\d/g);
        $('.rating').css('color', '');
        $('#rating').val(rate);
        $(this).css('color', '#2DB1FF');
        // Get Products
        getSearchedProduct();
    });
</script>

<script>
    var slider = document.getElementById("price");
    var output = document.getElementById("output");
    output.innerHTML = slider.value; // Display the default slider value

    // Update the current slider value (each time you drag the slider handle)
    slider.oninput = function() {
        output.innerHTML = 'Rs. 0.00 - Rs. ' + this.value + '.00';
        // Get Products
        getSearchedProduct();
    }
</script>

@if($products->avg('price'))
<script>
    output.innerHTML = 'Rs. 0.00 - Rs. ' + "{{  floor($products->avg('price')) }}" + '.00';
</script>
@endif


<script>
    function getSearchedProduct() {
        var price = $('#price').val();
        var sortby = $('#sortby').val();
        var sorttype = $('#sorttype').val();
        var rating = $('#rating').val();
        var search = $('#productInput').val();
        var stock = $("input[name='stock']:checked").val();
        var elements = document.querySelectorAll('input[type="checkbox"]:checked');
        var categories = Array.prototype.map.call(elements, function(element, i) {
            return element.value;
        });
        console.log(categories);
        var _data = {
            'sortby': sortby,
            'sorttype': sorttype,
            'search': search,
            'price': price,
            'rating': rating,
            'stock': stock,
            'categories': categories,
        };
        ajaxRequest("{{ route('products.search') }}", _data, 'get')
    }

    function ajaxRequest(_url, _data, _type) {
        $.ajax({
            url: _url,
            type: _type,
            data: _data,
            success: function(response) {
                // console.log(response);
                $('#products').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    $(".categories").click(function() {
        // Get Products
        getSearchedProduct();
    });

    $('input[type=radio][name=stock]').change(function() {
        // Get Products
        getSearchedProduct();
    });

    $('#sortby').change(function() {
        // Get Products
        getSearchedProduct();
    });

    $('#sorttype').change(function() {
        // Get Products
        getSearchedProduct();
    });
</script>


@endsection