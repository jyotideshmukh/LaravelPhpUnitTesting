<html>
   <head>
       <title>Taxonomies</title>
   </head>

    <body>
    <h1>Taxonomies</h1>
    <ul>
    @foreach($taxonomies as $taxonomy)
        <li>
            <h3>{{ $taxonomy->title }}</h3>
            <p>{{ $taxonomy->description  }}</p>
        </li>
    @endforeach
    </ul>
    </body>
</html>
