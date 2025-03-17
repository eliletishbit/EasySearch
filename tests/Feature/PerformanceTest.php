<?php
//test de performùance  test qui mesure le temps d'insertion des données dans la table excel_rows
//retoru : insertion de 1000 lignes en 3,4 secondes
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ExcelRow;

class PerformanceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function performance_of_inserting_large_number_of_rows()
    {
        // Nombre d'éléments à insérer
        $numberOfRows = 1000;

        // Mesurer le temps avant l'insertion
        $startTime = microtime(true);

        
        // Insérer des lignes dans la base de données
        ExcelRow::factory()->count($numberOfRows)->create();

        // Mesurer le temps après l'insertion
        $endTime = microtime(true);

        // Calculer le temps écoulé
        $executionTime = $endTime - $startTime;

        // Définir un seuil de performance acceptable (par exemple 2 secondes pour 1000 lignes)
        $this->assertLessThan(6,$executionTime, "L'insertion de $numberOfRows lignes a pris trop de temps.");

        // Facultatif : Afficher le temps pour inspection
        echo "Temps d'insertion pour $numberOfRows lignes : " . round($executionTime, 4) . " secondes.\n";
    }
}
