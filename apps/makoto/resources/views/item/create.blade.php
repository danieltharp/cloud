<form action="/items" method="post">
    {{csrf_field()}}
    <input type="text" placeholder="New Item" class="form-control" name="name" required autofocus>
    <input type="text" placeholder="Description (optional)" class="form-control" name="description">
    <select name="location_id">
        @foreach($locations as $location)
            <option value="{{$location->id}}" @if(old('location_id') == $location->id) selected @endif>{{$location->name}}</option>
        @endforeach
    </select>
    <button type="submit" name="item" class="btn btn-success">Create</button>
</form>