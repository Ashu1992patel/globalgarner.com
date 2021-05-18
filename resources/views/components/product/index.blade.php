@extends('master')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('products.index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Products
        </li>
    </ol>
</nav>

<div class="tableblock p-4">
    <div class="row">
        <div class="col-sm-12" id="myProducts">
            <div class="d-flex align-items-center">
                <h2>
                    All The Products
                </h2>
            </div>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th width="80px">@sortablelink('id')</th>
                        <th>Image</th>
                        <th>@sortablelink('title')</th>
                        <th>@sortablelink('price')</th>
                        <th>@sortablelink('stock')</th>
                        <th>@sortablelink('rating')</th>
                        <th>@sortablelink('created_at')</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $key=>$product)
                    <tr>
                        <td>
                            {{ $product->id }}
                        </td>
                        <td style="max-width: 50px;">
                            <img src="{{ $product->custom_image }}" alt="" style="width: 100%;">
                        </td>
                        <td>
                            {{ $product->title }}
                        </td>
                        <td>
                            {{ $product->custom_price }}
                        </td>
                        <td>
                            @if($product->stock)
                            <span class="badge badge-sm badge-info">
                                {{ $product->custom_stock??'N/A' }}
                            </span>
                            @else
                            <span class="badge badge-sm badge-warning">
                                {{ $product->custom_stock??'N/A' }}
                            </span>
                            @endif
                        </td>
                        <td>
                            {{ $product->rating??'N/A' }}
                        </td>
                        <td>
                            {{ $product->custom_created_at }}
                        </td>
                        <td>
                            <a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil"></i>
                            </a>
                            @if(auth()->check() and auth()->user()->role->name == 'Admin')
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to remove this product?')){ $('#product-destroy-{{ $product->id }}').submit(); }">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form action="{{ route('products.destroy',$product->id) }}" method="post" id="product-destroy-{{ $product->id }}" style="display: none;">
                                @csrf
                                @method(' delete') <button type="submit">DELETE</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <hr>
            <div class="d-flex justify-content-center float-right">
                {!! $products->appends(\Request::except('page'))->render() !!}
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
        var search = $('#productInput').val();
        var rating = $('#rating').val();
        var stock = $("input[name='stock']:checked").val();
        var elements = document.querySelectorAll('input[type="checkbox"]:checked');
        var categories = Array.prototype.map.call(elements, function(element, i) {
            return element.value;
        });
        console.log(categories);
        var _data = {
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
</script>


@endsection