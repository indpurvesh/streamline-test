<?php

namespace App\Http\Controllers;

use App\Http\Requests\DirectoryRequest;
use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $directories = Directory::with('user')->paginate(10);
        
        return view('directory.index')
            ->with('directories', $directories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directoryOptions = Directory::pluck('name', 'id');
        return view('directory.create')
            ->with('directoryOptions', $directoryOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DirectoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectoryRequest $request)
    {
        $request->merge(['user_id' => Auth::user()->id]);
        Directory::create($request->all());

        return redirect()->route('directory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function show(Directory $directory)
    {
        $directory->load(['children', 'files']);
        

        return view('directory.show')
            ->with('directory', $directory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function edit(Directory $directory)
    {
        $directoryOptions = Directory::pluck('name', 'id');

        return view('directory.edit')
            ->with('directoryOptions', $directoryOptions)
            ->with('directory', $directory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function update(DirectoryRequest $request, Directory $directory)
    {
        $directory->update($request->all());

        return redirect()->route('directory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Directory  $directory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Directory $directory)
    {
        $directory->delete();

        return redirect()->route('directory.index');
    }
}
