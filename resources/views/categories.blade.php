@extends('layout')

@section('main-content')

    <!-- lista di categorie -->
    <div class="categories">
        <h1>Categorie</h1>
        <ul>
            @foreach ($categories as $category)
                <li><a href="categories/{{$category->category_id}}">{{$category->name}}</a></li>
            @endforeach
        </ul>
    </div>
    
@endsection

