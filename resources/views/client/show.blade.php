@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h2>{{$client->title}}</h2></div>
            <div class="card-body">
                <h6> <strong>Description:</strong></h6><p>{{$client->description}}</p>
                <h6> <strong>Phone:</strong></h6><p>{{$client->phone}}</p>
                <h6> <strong>Contract Start Date:</strong></h6><p>{{date('Y-m-d', strtotime($client->contract_start_date))}}</p>
                <h6> <strong>Contract End Date:</strong></h6><p>{{date('Y-m-d', strtotime($client->contract_end_date))}}</p>
            </div>
        </div><br />

        @if(count($client->services)>0)
        <ul class="nav nav-tabs">
            @foreach($client->services as $service)
            <li class="nav-item"><a class="nav-link {{$client->services[0] === $service?"active":""}}" data-toggle="tab" href="#s{{$service->id}}">{{$service->serviceType->title}}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach($client->services as $service)
            <div id="s{{$service->id}}" class="tab-pane fade {{$client->services[0] === $service?"active show":""}}">
                <br />
                <h6> <strong>Title:</strong></h6><p>{{$service->title}}</p>
                <h6> <strong>Description:</strong></h6><p>{{$service->description}}</p>
                <h6> <strong>Link:</strong></h6><a href="{{$service->link}}">{{$service->link}}</a>


            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

@endsection
