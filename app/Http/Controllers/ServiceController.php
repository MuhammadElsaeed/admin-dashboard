<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceType;
use App\Service;
use App\Client;

class ServiceController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index() {
        return view('services')->with('services', ServiceType::all());
    }

    public function insert(Request $request) {
        $request->validate([
            'title' => 'required|unique:service_types'
        ]);
        $service = new ServiceType();
        $service->title = $request->title;
        $service->save();
        return redirect('services');
    }

    public function destroy($id) {
        $service = ServiceType::findOrFail($id);
        $service->delete();
        Service::where('type_id', $service->id)->delete();
        return redirect('services');
    }

    public function show($clientId) {
        $client = Client::findOrFail($clientId);
        // dd($client->services[0]->serviceType);
        return view('client.services')->with('client', $client);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'link' => ['nullable', 'url']
        ]);

        $service = Service::findOrFail($id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->link = $request->link;
        $service->save();
        return redirect('clients/' . $service->client_id);
    }

}
