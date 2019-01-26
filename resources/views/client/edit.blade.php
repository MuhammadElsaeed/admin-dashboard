@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-primary">
                <h2><strong>Edit Client</strong></h2>
            </div>
            <div class="card-body">
                <form action="{{action('ClientController@update',$client->id)}}" method="POST" name="clientForm" onsubmit="return validateClient()">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" id="title" class="form-control" placeholder="Client title" value="{{$client->title}}" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Client description" >{{$client->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="text"  name="phone" id="phone" class="form-control" placeholder="Phone number"value="{{$client->phone}}" required />
                        <small id="phoneError" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="contractStartDate">Contract start date</label>
                        <input type="date"  name="contractStartDate" id="contractStartDate" class="form-control"
                               value="{{date('Y-m-d', strtotime($client->contract_start_date))}}" required  />

                    </div>
                    <div class="form-group">
                        <label for="contractEndDate">Contract end date</label>
                        <input type="date"  name="contractEndDate" id="contractEndDate" class                       ="form-control"
                               value="{{date('Y-m-d', strtotime($client->contract_end_date))}}" required  />
                        <small id="dateError" class="text-danger"></small>

                    </div>
                    @if(count($services)>0)
                    <div class="checkbox-group required">
                        @foreach($services as $service)
                        <div class="form-check-inline">
                            <input  class="form-check-input" type="checkbox" name="servicesList[]" 
                                    value="{{$service->id}}"
                                    {{$client->servicesTypes->contains($service->id)?'checked':''}} />
                            <label class="form-check-label">{{$service->title}}</label>
                        </div>
                        @endforeach
                        <br />  
                        <small id="servicesError" class="text-danger"></small>
                    </div>
                    @endif
                    <br />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" required/>
                    <input type="hidden" name="_method" value="PUT" required/>
                    <button type="submit" class="btn btn-success">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection