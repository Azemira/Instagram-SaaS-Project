<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Proxy;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Proxy::paginate(10);

        return view('proxy.index', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = config('countries');

        return view('proxy.create', compact(
            'countries'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'server'     => 'required',
            'expires_at' => 'nullable|date',
            'country'    => 'nullable|max:2',
        ]);

        // Check for proxy validity
        try {

            $client = new Client([
                'exceptions' => false,
            ]);
            $client->request('GET', 'http://www.google.com', [
                'proxy' => $request->get('server'),
            ]);

        } catch (\Exception $e) {
            return redirect()->route('settings.proxy.create')
                ->with('error', __('Can\'t connect to proxy'));
        }

        Proxy::create($request->all());

        return redirect()->route('settings.proxy.index')
            ->with('success', __('Created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proxy  $proxy
     * @return \Illuminate\Http\Response
     */
    public function edit(Proxy $proxy)
    {
        $countries = config('countries');

        return view('proxy.edit', compact(
            'proxy',
            'countries'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proxy  $proxy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proxy $proxy)
    {
        $request->validate([
            'server'     => 'required',
            'expires_at' => 'nullable|date',
            'country'    => 'nullable|max:2',
        ]);

        // Check for proxy validity
        try {

            $client = new Client([
                'exceptions' => false,
            ]);
            $client->request('GET', 'http://www.google.com', [
                'proxy' => $request->get('server'),
            ]);

        } catch (\Exception $e) {
            return redirect()->route('settings.proxy.edit', $proxy)
                ->with('error', __('Can\'t connect to proxy'));
        }

        $proxy->update($request->all());

        return redirect()->route('settings.proxy.edit', $proxy)
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proxy  $proxy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proxy $proxy)
    {
        // Unset used
        Account::where('proxy_id', $proxy->id)->update([
            'proxy_id' => null,
        ]);

        $proxy->delete();

        return redirect()->route('settings.proxy.index')
            ->with('success', __('Deleted successfully'));
    }
}
