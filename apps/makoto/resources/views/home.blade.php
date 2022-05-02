@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('link'))
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading">Success</div>
                    <div class="panel-body">{!! Session::get('link') !!}</div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add Location</div>
                <div class="panel-body">
                    @include('location.create')
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add Item</div>

                <div class="panel-body">
                    @include('item.create')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">List</div>
                <div class="panel-body">
                    <ul>
                        @foreach($locations as $location)
                            @include('home.locationloop')
                            @if($loop->first)
                                @break
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
