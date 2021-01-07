<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komentaras;
use App\Straipsnis;
use App\Puslapis;
use App\Kategorija;
use Session;
use Validator;

class CommentsControler extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $post_id)
    {

        $this->validate($request , [
            'useris' => 'required',
            'email' => 'required|email',
            'turinys' => 'required'
        ]);

        $straipsnis = Straipsnis::find($post_id);

        $komentaras = new Komentaras;

        $komentaras->useris = $request->useris;
        $komentaras->email = $request->email;
        $komentaras->turinys = $request->turinys;
        $komentaras->straipsnis()->associate($straipsnis);
        $komentaras->sukurimo_data = now();

        $komentaras->save();

        Session::flash('success', "Komentaras sekmingai sukurtas!");
        
       // return redirect('');
      // return \Redirect::route('straipsniai', [$id])->with('message', 'State saved correctly!!!');

       // return \Redirect::route('straipsniai', ['kategorija'=>$straipsnis->category->pavadinimas, 'id'=>$post_id]);

        return redirect()->action('PostController@show', ['kategorija'=>$straipsnis->category->pavadinimas, 'id'=>$post_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komentaras = Komentaras::find($id);

        $puslapiai = Puslapis::all();
        $kategorijos = Kategorija::all();
        return view('komentarai.edit', compact('komentaras', "puslapiai", "kategorijos"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'useris' => 'required',
            'email' => 'required',
            'turinys' => 'required',
        ]);

        //dd($request->pavadinimas);

        //$straipsnis = Straipsnis::find($request->id);
        $komentaras = Komentaras::find($id);
        $kategorija = Kategorija::find($komentaras->straipsnis->fk_Straipsnio_kategorija_id);

        $komentaras->useris = $request->useris;
        $komentaras->email = $request->email;
        $komentaras->turinys = $request->turinys;
       // $komentaras->straipsnis()->associate($straipsnis);
        $komentaras->sukurimo_data = now();

        $komentaras->save();
         //$straipsnis->update();
        return redirect()->action('PostController@show', ['kategorija'=>$kategorija->pavadinimas, 'id' =>$komentaras->straipsnis->id]);
       // return redirect('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentaras = Komentaras::find($id);
        $kategorija = Kategorija::find($komentaras->straipsnis->fk_Straipsnio_kategorija_id);
        $komentaras->delete();
      //  return redirect('');
      return redirect()->action('PostController@show', ['kategorija'=>$kategorija->pavadinimas, 'id' =>$komentaras->straipsnis->id]);
     // return redirect()->action('PostController@straipsniai', ['kategorija'=>$straipsnis1->category->pavadinimas]);
    }
}
