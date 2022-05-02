@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 p-8">
            <h1>Details</h1>
            <form action="/items/{{$item->id}}" method="post">
                {{ method_field('patch') }}
                {{csrf_field()}}
                <div class="form-group">
                    <label class="control-label" for="name">Item name*</label>
                    <input type="text" value="{{$item->name}}" class="form-control" name="name" required autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Item description</label>
                <input type="text" value="{{$item->description}}" class="form-control" name="description">
                </div>
                <div class="form-group">
                    <label class="control-label" for="make_model">Make and Model</label>
                    <input type="text" value="{{$item->make_model}}" class="form-control" name="make_model">
                </div>
                <div class="form-group">
                    <label class="control-label" for="serial_number">Serial Number</label>
                    <input type="text" value="{{$item->serial_number}}" class="form-control" name="serial_number">
                </div>
                <div class="form-group">
                    <label class="control-label" for="date_purchased">Date Purchased</label>
                    <input type="date" value="{{$item->date_purchased}}" class="form-control" name="date_purchased">
                </div>
                <div class="form-group">
                    <label class="control-label" for="where_purchased">Purchased location</label>
                    <input type="text" value="{{$item->where_purchased}}" class="form-control" name="where_purchased">
                </div>
                <div class="form-group">
                    <label class="control-label" for="purchase_price">Purchase Price ($)</label>
                    <input type="number" value="{{$item->purchase_price/100}}" class="form-control" min="0" step="0.01" name="purchase_price" inputmode="decimal">
                </div>
                <div class="form-group">
                    <label class="control-label" for="estimated_value">Estimated Value ($)</label>
                    <input type="number" value="{{$item->estimated_value/100}}" class="form-control" min="0" step="0.01" name="estimated_value" inputmode="decimal">
                </div>
                <div class="form-group">
                    <label class="control-label" for="location_id">Location</label>
                    <select name="location_id" class="form-control dropdown">
                        @foreach(\App\Location::all() as $location)
                            <option value="{{$location->id}}" @if($item->location_id == $location->id) selected @endif>{{$location->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" name="item" class="btn btn-success">Update</button>
            </form>
        </div>

        <div class="col-xs-12">
            <h1>Photos</h1>
            @if (count($item->photos) > 1)
                @foreach($item->photos as $photo)
                    <a href="{{$photo->full_path}}"><img src="{{$photo->thumbnail_path}}"></a>
                @endforeach
            @else
                No photos found.
            @endif
            <form action="/items/{{$item->id}}/photos" method="post">
                {{csrf_field()}}
            <div class="form-group">
                <label class="control-label" for="location_id">Location</label>
                <input class="form-control" type="file" accept="image/*" multiple>
            </div>
        </div>
    </div>
</div>
@endsection
