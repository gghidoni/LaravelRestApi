@extends('layout')

@section('main-content')
    <!-- singola categoria e lista prodotti -->
    <div class="category">
        <h1>{{$category->name}}</h1>
        <h4>Prodotti:</h4>
        @if (isset($category->products))
            <ul>
                @foreach ($category->products as $product)
                    <li><a href="/categories/{{$category->category_id}}/products/{{$product}}">{{$product}}</a></li>
                @endforeach
            </ul>
        @endif
    </div>  
@endsection

