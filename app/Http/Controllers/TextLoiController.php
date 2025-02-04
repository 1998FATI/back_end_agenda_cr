<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\TextLoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TextLoiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TextLoi::query();     
        $titre = $request->input('titre');
    
        if (!empty($titre)) {
            $query->where('titre', 'like', "%$titre%");
        }
        $textLois = $query->get();
        return view('textlois.dashboardLoi', compact('textLois'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    { 
        $request->validate([
            'titre' => 'required|string|max:255',
            'pdf' => 'required|mimes:pdf|max:2048'
        
        ]);

        $pdfPath = $request->file('pdf')->store('pdfs', 'public');
    $textLoi = TextLoi::create([
        'titre' => $request->titre,
        'pdf' => $pdfPath
    ]);


    return redirect()->route('lois.list')->with('success', 'تمت إضافة الملف بنجاح !');    }

    public function show(TextLoi $textLoi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TextLoi $textLoi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
   

    public function update(Request $request, $id)
    {
        $texteLoi = TextLoi::findOrFail($id);
    
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'titre' => 'required|string',
            'pdf' => 'nullable|mimes:pdf|max:2048' // Rendre le PDF facultatif
        ]);
    
        // Mettre à jour le titre
        $texteLoi->titre = $validatedData['titre'];
    
        // Vérifier si un nouveau fichier a été envoyé
        if ($request->hasFile('pdf')) {
            // Supprimer l'ancien fichier s'il existe
            if ($texteLoi->pdf) {
                Storage::disk('public')->delete($texteLoi->pdf);
            }
            // Enregistrer le nouveau fichier
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
            $texteLoi->pdf = $pdfPath;
        }
    
        // Sauvegarder les modifications
        $texteLoi->save();
    
        session()->flash('success', 'تم التعديل بنجاح !');
    
        // Redirection avec un message de succès
        return redirect()->route('lois.list')->with('success', 'تم تحديث الملف بنجاح !');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver l'organ par son ID
    $texteLoi = TextLoi::find($id);

    // Vérifier si l'organ existe
    if (!$texteLoi) {
        return redirect()->route('lois.list')->with('error', 'الملف غير موجود.');
    }

    // Supprimer l'organ
    $texteLoi->delete();
    session()->flash('success', 'تم الحذف بنجاح !');

    // Rediriger vers la liste avec un message de succès
    return redirect()->route('lois.list')->with('success', 'تم حذف الملف بنجاح !');
    }
}
