<form action="/locations" method="post">
    {{csrf_field()}}
    <input type="text" placeholder="New Location" class="form-control" name="name" required>
    <input type="text" placeholder="Description (optional)" class="form-control" name="description">
    <select name="location_id">
            <option value="">Root-Level Location</option>
        @foreach($locations as $location)
            <option value="{{$location->id}}" @if(old('location_id') == $location->id) selected @endif>{{$location->name}}</option>
        @endforeach
    </select>
    <button type="submit" name="location" class="btn btn-success">Create</button>
</form>