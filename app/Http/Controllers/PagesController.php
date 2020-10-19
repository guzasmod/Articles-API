<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Puslapis;
use App\Kategorija;
use App\Straipsnis;
use Validator;

class PagesController extends Controller
{
    public function index()
    {
        $puslapiai = Puslapis::all()->toArray();
        $kategorijos = Kategorija::all()->toArray();
      //  $data = array('title' => 'Pagrindinis');
      //  $title = 'Welcome to Laravel';
        //return view ('pages.index', compact('title'));
        //return view ('pages.index')->with('title', $title);
       // return view ('pages.index')->with($data);
        return view ('pages.index', compact('puslapiai', 'kategorijos'));
    }

    public function kontaktai()
    {
        $puslapiai = Puslapis::all();
        $kategorijos = Kategorija::all()->toArray();
        return view ('pages.kontaktai',  compact('puslapiai', 'kategorijos'));
    }

    public function straipsniai($kategorija)
    {
        $straipsniai = Straipsnis::all();
       // dd($mityba[0]->category->pavadinimas);
       // dd($straipsniai[0]->category);
        $puslapiai = Puslapis::all();
        $kategorijos = Kategorija::all();
        return view ('pages.straipsniai',  compact('puslapiai', 'kategorijos', 'straipsniai', 'kategorija'));
    }

    public function create()
    {
        $puslapiai = Puslapis::all();
        $kategorijos = Kategorija::all();
        return view('kategorijos.create', compact("puslapiai", "kategorijos"));
        //return view('straipsniai.create');
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'pavadinimas' => 'required'
        ]);

        $kategorija = new Kategorija;

        $kategorija->pavadinimas = $request->pavadinimas;

        $kategorija->save();

       // Session::flash('success', "Straipsnis sekmingai sukurtas!");

        //dd(request()->all());

        $currentKategorija = Kategorija::where('id', $request->kategorija)->get();
        
        $kategorijaa = $currentKategorija[0]->pavadinimas;   
        //dd($kategorija);
        //return redirect()->route('straipsniai', ['kategorija' => $kategorija]);
        return redirect()->action('PostController@straipsniai', ['kategorija'=>$kategorija->pavadinimas]);
       // return redirect('');

    }
}
