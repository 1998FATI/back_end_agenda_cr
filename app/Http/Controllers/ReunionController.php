<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use App\Models\Reunion;
use Illuminate\Support\Facades\Validator;


class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllReunions()
    {
        $reunions = Reunion::with('organ')->get(); // Récupère toutes les réunions avec les organes associés
    
        return response()->json($reunions); // Renvoie les réunions sous forme de JSON
    }

    public function index(Request $request)
{
    $organs = Organ::with('reunions')->get();

    // Récupérer les critères de recherche depuis la requête
    $objet = $request->input('objet');
    $date_reunion = $request->input('date_reunion');
    $organ_id = $request->input('organ_id');

    // Début de la requête
    $query = Reunion::with('organ')->latest();

    // Appliquer les filtres si les valeurs sont fournies
    if (!empty($objet)) {
        $query->where('objet', 'like', "%$objet%");
    }

    if (!empty($date_reunion)) {
        $query->whereDate('date_reunion', $date_reunion);
    }

    if (!empty($organ_id)) {
        $query->where('id_organs', $organ_id);
    }

    // Exécuter la requête avec pagination
    $reunions = $query->paginate(5);


    return view('reunions.dashboardReunion', compact('organs', 'reunions'));
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
        // Validation des données d'entrée
        $validator = Validator::make($request->all(), [
            'objet' => 'required|string',
            'details' => 'required|string',
            'id_organs' => 'required|exists:organs,id',
            'date_reunion' => 'required|date',
            'salle' => 'required|integer|min:1|max:100', 
            'heure'=>'required|date_format:H:i',
        ]);
    
        // Vérification de la validation
        if ($validator->fails()) {
            dd($validator->errors()); // Affiche les erreurs pour le débogage
            return redirect()->route('reunions.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Création de la réunion si la validation réussit
        $reunion = Reunion::create([
            'objet' => $request->objet,
            'details' => $request->details,
            'id_organs' => $request->id_organs,
            'date_reunion' => $request->date_reunion,
            'salle' => $request->salle,
            'heure'=>$request->heure,
        ]);
    
      session(['reunion_id' => $reunion->id]);

    session()->flash('success', 'تم تسجيل الاجتماع بنجاح !');

    return redirect()->route('reunions.list', ['reunion_id' => $reunion->id])
        ->with('success', 'تم تسجيل الاجتماع بنجاح !');
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
        $reunion= Reunion::findOrFail($id);
    
        // Validez les données du formulaire 
        $validatedData = $request->validate([
            'objet' => 'required|string',
            'details' => 'required|string',
            'id_organs' => 'required|exists:organs,id',
            'date_reunion' => 'required|date',
            'salle' => 'required|integer|min:1|max:100',
            'heure'=>'required|date_format:H:i',
        ]);
    
        // Mettez à jour les champs du réunion
        $reunion->objet = $validatedData['objet'];
        $reunion->details = $validatedData['details'];
        $reunion->id_organs = $validatedData['id_organs'];
        $reunion->date_reunion = $validatedData['date_reunion'];
        $reunion->salle = $validatedData['salle'];
        $reunion->heure = $validatedData['heure'];

        // Enregistrez les modifications
        $reunion->save();
        session()->flash('success', 'تم تعديل الاجتماع بنجاح !');

        return redirect()->route('reunions.list')->with('success', 'تم تعديل الاجتماع بنجاح !');
    }

    /**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    // Trouver la réunion par son ID
    $reunion = Reunion::find($id);

    // Vérifier si la réunion existe
    if (!$reunion) {
        return redirect()->route('reunions.list')->with('error', 'الاجتماع غير موجود.');
    }

    // Supprimer l'organ
    $reunion->delete();

    session()->flash('success', 'تم حذف الاجتماع بنجاح !');
    return redirect()->route('reunions.list')->with('success', 'تم حذف الاجتماع بنجاح !');
}

}
