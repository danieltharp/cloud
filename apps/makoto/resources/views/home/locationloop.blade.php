<b>{{$location->name}}</b>
<ul>
    @foreach($location->items as $item)
        <li><a href="/items/{{$item->id}}/edit" title="{{$item->description}}">{{$item->name}}</a></li>
    @endforeach
    @foreach($location->sublocations as $location)
        @include('home.locationloop')
    @endforeach
</ul>