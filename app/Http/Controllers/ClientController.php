<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceType;
use App\Service;
use App\Client;

class ClientController extends Controller {

    private $validationArray = [
        'title' => 'required|string',
        'phone' => ['required', 'regex:/\d{3}-\d{3}-\d{4}|\d{10}/'],
        'contractStartDate' => 'required|date',
        'contractEndDate' => 'required|date|after_or_equal:contractStartDate',
        'servicesList' => 'required|array|min:1'
    ];

    private function storeClientDataFromRequest($client, Request $request) {
        $client->title = $request->title;
        $client->phone = $request->phone;
        $client->description = $request->description;
        $client->contract_start_date = $request->contractStartDate;
        $client->contract_end_date = $request->contractEndDate;
        $client->save();
    }

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('client.add')->with("services", ServiceType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate($this->validationArray);
        $client = new Client();
        $this->storeClientDataFromRequest($client, $request);

        foreach ($request->servicesList as $serviceId) {
            $client->services()->save(new Service(['type_id' => $serviceId]));
        }
        return redirect("");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $client = Client::findOrFail($id);
        return view('client.show')->with('client', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $client = Client::findOrFail($id);
        $client->servicesTypes = $client->services->pluck('type_id');
        return view('client.edit')->with('client', $client)
                        ->with('services', ServiceType::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate($this->validationArray);
        $client = Client::findOrFail($id);
        $this->storeClientDataFromRequest($client, $request);

        foreach ($client->services as $service) {
            if (!in_array($service->type_id, $request->servicesList)) {
                $service->delete();
            }
        }
        
        $servicesTypes = $client->services->pluck('type_id');
        foreach ($request->servicesList as $serviceId) {
            if (!$servicesTypes->contains($serviceId)) {
                $client->services()->save(new Service(['type_id' => $serviceId]));
            }
        }
        return redirect("");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $client = Client::findOrFail($id);
        foreach ($client->services as $service) {
            $service->delete();
        }
        $client->delete();
        return redirect('');
    }

}
