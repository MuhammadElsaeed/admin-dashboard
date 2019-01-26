@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-success">
                <h2><strong>Add Client</strong></h2>
            </div>
            <div class="card-body">
                <form action="{{action('ClientController@store')}}" method="POST" name="clientForm" onsubmit="return validateClient()">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" id="title" class="form-control" placeholder="Client title" required />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Client description" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="text"  name="phone" id="phone" class="form-control" placeholder="Phone number" required />
                        <small id="phoneError" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="contractStartDate">Contract start date</label>
                        <input type="date"  name="contractStartDate" id="contractStartDate" class="form-control" required  />
                    </div>
                    <div class="form-group">
                        <label for="contractEndDate">Contract end date</label>
                        <input type="date"  name="contractEndDate" id="contractEndDate" class="form-control" required />
                        <small id="dateError" class="text-danger"></small>

                    </div>

                    @if(count($services)>0)
                    <div class="checkbox-group required">
                        @foreach($services as $service)
                        <div class="form-check-inline">
                            <input  class="form-check-input" type="checkbox" name="servicesList[]" value="{{$service->id}}" />
                            <label class="form-check-label">{{$service->title}}</label>
                        </div>
                        @endforeach
                        <br />  
                        <small id="servicesError" class="text-danger"></small>
                    </div>
                    @endif
                    <br />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" required/>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection