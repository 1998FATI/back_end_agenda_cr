<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use Illuminate\Support\Facades\Validator;

class OrganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{   
    $query = Organ::query(); 
    
    $objet = $request->input('libelle');

    if (!empty($objet)) {
        $query->where('libelle', 'like', "%$objet%");
    }    

    $organs = $query->get(); 
    
    return view('organs.dashboardOrgans', compact('organs'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('organs.ajouterOrgans');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données d'entrée
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string',
        ]);
    
        // Vérification de la validation
        if ($validator->fails()) {
            dd($validator->errors()); // Affiche les erreurs pour le débogage
            return redirect()->route('organs.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Création de la réunion si la validation réussit
        $organ = Organ::create([
            'libelle' => $request->libelle,
        ]);
    
        // Enregistrer l'ID de la réunion dans la session
        session(['organ_id' => $organ->id]);
        session()->flash('success', 'Organ ajouté avec succès !');
        // Redirection avec un message de succès
        return redirect()->route('organs.list', ['organ_id' => $organ->id])
            ->with('success', 'Organ enregistré avec succès !');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $organ= Organ::findOrFail($id);
    
        // Validez les données du formulaire 
        $validatedData = $request->validate([
            'libelle' => 'required|string',
        ]);
    
        // Mettez à jour les champs du Organ
        $organ->libelle = $validatedData['libelle'];
        // Enregistrez les modifications
        $organ->save();
        session()->flash('success', 'Organ modifié avec succès !');
        // Redirigez vers la liste des Organs avec un message de succès
        return redirect()->route('organs.list')->with('success', 'organ mis à jour avec succès !');
    }

    /**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    // Trouver l'organ par son ID
    $organ = Organ::find($id);

    // Vérifier si l'organ existe
    if (!$organ) {
        return redirect()->route('organs.list')->with('error', 'Organ introuvable.');
    }

    // Supprimer l'organ
    $organ->delete();
     session()->flash('success','Organ supprimé avec succés !');
    // Rediriger vers la liste avec un message de succès
    return redirect()->route('organs.list')->with('success', 'Organ supprimé avec succès !');
}

}
