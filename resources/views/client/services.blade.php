@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>{{$client->title}}</h2>
        @if(count($client->services)>0)
        <strong class="text-danger" id="linkError"></strong>
        <ul class="nav nav-tabs">
            @foreach($client->services as $service)
            <li class="nav-item"><a class="nav-link {{$client->services[0] === $service?"active":""}}" data-toggle="tab" href="#s{{$service->id}}">{{$service->serviceType->title}}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($client->services as $service)
            <div id="s{{$service->id}}" class="tab-pane fade {{$client->services[0] === $service?"active show":""}}">
                <form onsubmit="return validateService(event)" action="{{action('ServiceController@update',$service->id)}}" method="POST" name="serviceForm">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" id="title" class="form-control" placeholder="Title" value="{{$service->title}}"  />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Description">{{$service->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input name="link" id="link" class="form-control" placeholder="{{$service->serviceType->title}} link" value="{{$service->link}}"  />

                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" required/>
                    <input type="hidden" name="_method" value="PUT" required/>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>

            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
