

@extends('product-layout')

@section('item')

    <!-- titolo -->
    <div class="title">
        <h1>{{$item['item']->name}}</h1>
        <span>{{$item['item']->product_code}}</span>
    </div>

    <!-- prezzo -->
    <div class="price">
        <span>€ {{$item['item']->prices->list->default}}</span>
    </div>

    <!-- selezione colore -->
    <div class="color">
        <span>{{$item['item']->color}}</span>
        <div class="buttons">
            @foreach ($items as $prodItem)
            <a href="{{$prodItem['sku']}}">{{$prodItem['item']->color}}</a>
            @endforeach
        </div>
    </div>
 
@endsection