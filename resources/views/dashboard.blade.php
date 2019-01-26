@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/services" class="btn btn-success">Add Service</a>
        <a href="{{action('ClientController@create')}}" class="btn btn-success float-right">Add Client</a>
    </div>
</div>
<div class="row mt-5"></div>

<div class="row mt-5"></div>

@if(count($clients)>0)

<div class="row">
    <table class="datatable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Show</th>
                <th>Edit</th>
                <th>Manage Services</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <?php
            $start = \Carbon\Carbon::createFromTimeString($client->contract_start_date);
            $end = \Carbon\Carbon::createFromTimeString($client->contract_end_date);
            $client->status = today()->between($start, $end);
            ?>
            <tr>
                <td>{{$client->title}}</td>
                @if($client->status)
                <td ><a class="btn btn-default"><span class="fa fa-toggle-on text-success"></span></a></td>
                @else
                <td ><a class="btn btn-default"><span class="fa fa-toggle-off text-danger"></span></a></td>
                @endif
                <td><a href="{{action('ClientController@show',$client->id)}}" class="btn btn-primary">
                        <span class="fa fa-eye"></span></a></td>
                <td><a href="{{action('ClientController@edit',$client->id)}}" class="btn btn-primary">
                        <span class="fa fa-edit"></span></a></td>
                <td><a href="{{action('ServiceController@show',$client->id)}}" class="btn btn-primary">
                        <span class="fa fa-bell"></span></a></td>
                <td>
                    <form action="{{ action('ClientController@destroy', $client->id) }}" method="post">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <button  class="btn btn-danger" type="submit"> 
                            <span class="fa fa-trash"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
