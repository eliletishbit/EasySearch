<?php

namespace App\Http\Controllers;

use App\Models\ExcelRow;  // Modèle qui représente les lignes de données
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport; // Export personnalisé (il faut le créer)
use Illuminate\Http\Request;

class ExcelExportController extends Controller
{
    // Exporter toutes les lignes de données au format Excel
    public function export()
    {
        try {
            return Excel::download(new ExcelExport, 'export.xlsx'); // Télécharge le fichier Excel
        } catch (\Exception $e) {
            return back()->withErrors('Erreur lors de l\'exportation: ' . $e->getMessage());
        }
    }
}
