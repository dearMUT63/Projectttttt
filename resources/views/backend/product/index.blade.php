@extends('layouts.app')

@section('content')
    <a href="{{route("product.create")}}" class = "btn btn-success">Add Product</a>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Price</th>
            <th>Tool</th>
            @foreach ($products as $product)
        <tr>
            <td>
                {{ $product->product_name }}
            </td>
            <td>
                <img src="{{ URL::asset('images/' . $product->product_image) }}" height="100" width="100" >
            </td>
            <td>
                {{ $product->product_description }}
            </td>
            <td>
                {{ $product->product_price }}
            </td>
            <td>
                <a href="{{route('product.edit',['product'=> $product->id])}}" class="btn btn-warning text-white">Edit</a>
                <form action="{{ route('product.destroy', ['product' => $product->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tr>
    </table>
@endsection
