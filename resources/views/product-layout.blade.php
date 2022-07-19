@extends('layout')


@section('main-content')
    
    <section class="item">
        @yield('item')
    </section>


    <section class="product-model">

        @if ($language == "it")
            <h4>Dettagli</h4>
        @else
            <h4>Details</h4>
        @endif
        

        <!-- Caratteristiche principali --->
        <div class="info">
            @if ($language == "it")
                <h5>Caratteristiche Principali</h5>
            @else
                <h5>Main Features</h5>
            @endif
            
            <ul>
                @foreach ($model->features as $key => $values)
                    <li>{{$values[0]}}</li>
                @endforeach
            </ul>
        </div>

        <!-- Personalizzazione font --->
        @if ($model->customization->available)
            <div class="info">
                @if ($language == "it")
                    <h5>Personalizzazione</h5>
                @else
                    <h5>Customization</h5>
                @endif
                
                <ul>
                @foreach ($model->customization->customization_fonts as $font)
                    <li>{{$font->name}}</li>
                @endforeach
                </ul>
                <span>
                    @if ($language == "it")
                        Confezione regalo: 
                    @else
                        Gift box:
                    @endif
                    {{$model->giftwrap_type}}
                </span>
            </div>
        @endif

        <!-- Dimensioni prodotto --->
        <div class="info">
            @if ($language == "it")
                <h5>Dimensioni prodotto</h5>
            @else
                <h5>Product dimensions</h5>
            @endif
            
            <ul>
                <li>Misure: {{$model->dimensions->product->width}} x {{$model->dimensions->product->height}} x {{$model->dimensions->product->length}} cm</li>
                <li>EAN: {{$item['item']->ean}}</li>
            </ul>
        </div>


        @foreach ($model->features as $key => $values)
            <div class="info">
                <h5>{{$key}}</h5>
                <ul>
                @foreach ($values as $value)
                    <li>{{$value}}</li>    
                @endforeach
                </ul>
            </div>
        @endforeach

    </section>



@endsection




