<?php

namespace App\Http\Controllers;

use App\Models\TermsAndCondition;
use App\Http\Requests\StoreTermsAndConditionRequest;
use App\Http\Requests\UpdateTermsAndConditionRequest;
use Illuminate\Http\Request;
use Laravel\Prompts\Terminal;

class TermsAndConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TermsAndCondition $termsAndCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TermsAndCondition $termsAndCondition)
    {
        $terms = TermsAndCondition::first();
        if (!$terms) {
            $terms = TermsAndCondition::create(['content' => '']);
        }
        return view('pages.termscondition.edit', compact('terms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request , $id)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $terms = TermsAndCondition::findOrfail($id); 
        $terms->update($request->all());
        $terms->save();

        return back()->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TermsAndCondition $termsAndCondition)
    {
        //
    }
}
