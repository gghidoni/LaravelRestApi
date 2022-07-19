@extends('layout')

@section('main-content')

    <!-- lista di categorie -->
    <div class="categories">
        @if ($language == "it")
            <h1>Categorie</h1>
        @else
            <h1>Categories</h1>
        @endif
        
        <ul>
            @foreach ($categories as $category)
                <li><a href="categories/{{$category->category_id}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>

    
@endsection

