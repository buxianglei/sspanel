<?php

namespace App\Http\Controllers\Help;

use App\Models\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\HelpTransformer;

class ListController extends Controller
{
    protected $helpTransformer;

    public function __construct(HelpTransformer $helpTransformer)
    {
        $this->helpTransformer = $helpTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Help $help)
    {
        $attritube = $help->all();

        $attritube = $this->helpTransformer->transforms($attritube);

        return $this->responseSuccess($attritube);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function show(Help $help, $id)
    {
        $attritube = $help->find($id);

        return $this->responsseSuccess($attritube);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function edit(Help $help)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Help $help)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Help  $help
     * @return \Illuminate\Http\Response
     */
    public function destroy(Help $help)
    {
        //
    }
}
