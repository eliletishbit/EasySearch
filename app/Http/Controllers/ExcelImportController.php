<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use App\Models\ExcelRow;

use Maatwebsite\Excel\Validators\ValidationException;
use Exception;

class ExcelImportController extends Controller
{
    // Afficher le formulaire d'importation
    public function showForm()
    {
        return view('import');
    }

    // Traitement de l'importation
    public function import(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Maximum 10MB
        ]);
    
        try {
            // Importer le fichier
            Excel::import(new ExcelImport, $request->file('file'));
    
            // Retourner un message de succès
            return redirect()->route('files.index')->with('success', 'Fichier importé avec succès !');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // En cas d'erreur de validation des données
            $failures = $e->failures();
            return redirect()->route('home')->withErrors($failures)->with('error', 'Erreur de validation lors de l\'importation.');
        } catch (\Throwable $e) {
            // Affiche le message exact de l'erreur
            return redirect()->route('home')->with('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }
    
    // Liste des fichiers importés
    public function index()
    {
        // Récupérer tous les fichiers ou enregistrements
        $files = ExcelRow::all();
        return view('home', compact('files'));
    }

    // Voir un fichier spécifique
    public function viewFile($id)
    {
        $file = ExcelRow::findOrFail($id);
        return view('home', compact('file'));
 
 
    }

    public function destroy($id)
    {
        $file = ExcelRow::find($id);
    
        if (!$file) {
            return redirect()->route('home')->with('error', 'Fichier introuvable.');
        }
    
        $file->delete();
    
        return redirect()->route('home')->with('success', 'Fichier supprimé avec succès.');
    }
    

    // Méthode pour afficher le formulaire de modification
public function edit($id)
{
    $file = ExcelRow::find($id);

    if (!$file) {
        return redirect()->route('home')->with('error', 'Fichier introuvable.');
    }

    return view('home', compact('file')); // Assurez-vous d'avoir une vue pour l'édition
}

// Méthode pour mettre à jour le fichier
public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email',
        'telephone' => 'required|string',
    ]);

    $file = ExcelRow::find($id);

    if (!$file) {
        return redirect()->route('home')->with('error', 'Fichier introuvable.');
    }

    $file->update($request->all());

    return redirect()->route('home')->with('success', 'Fichier modifié avec succès.');
}


}
