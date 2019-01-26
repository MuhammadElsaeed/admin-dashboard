@extends('layouts.app')
@section('content')
<div class="col-md-10">
    <div class="row">
        <form action="services" method="POST">
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" id="title" class="form-control" placeholder="new service type" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" required/>
            </div>
            <button type="submit" class="btn btn-success">Add</button>
        </form>
    </div>

    <div class="row mt-5"></div>
    @if(count($services)>0)

    <div class="row">
        <table class="datatable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{$service->title}}</td>
                    <td>
                        <form action="{{action('ServiceController@destroy',$service->id) }}" method="post">
                            <input type="hidden" name="_method" value="DELETE" />
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
</div>

@endif
@endsection