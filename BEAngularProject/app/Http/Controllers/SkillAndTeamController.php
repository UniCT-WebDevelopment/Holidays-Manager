<?php
/**
 * Autobot project.
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Dipendente;
use App\Permessi;
use App\Sottoposti;
use App\Skill;
use App\SkillDipendente;
use App\Team;
use App\TeamDipendente;
use Carbon\Carbon;
/**
 *
 *@deprecated See WebHookVotaController
 */
class SkillAndTeamController extends Controller
{
    public function generateMockDataGiovanni(Request $request)
    {
        Dipendente::truncate();
        Permessi::truncate();
        Skill::truncate();
        SkillDipendente::truncate();
        Team::truncate();
        TeamDipendente::truncate();

        $skillMockList = [
            ['nome' => 'Angular'],
            ['nome' => 'Java'],
            ['nome' => 'PHP']
        ];

        $mockList = [
            [
                'nome' => 'Orazio',
                'cognome' => 'Contarino',
                'email' => 'ocontarino@gmail.com',
                'codice_fiscale' => 'ORZCNT93P12C351Q',
                'data_nascita' => Carbon::now(),
                'password' => 'prova123',
                'iban' => '53535535353535353',
                'banca' => 'Poste Italiane',
                'bbc' => 'prova',
                'ruolo' => 'manager'
            ],
            [
                'nome' => 'Giovanni',
                'cognome' => 'Longo',
                'email' => 'giovanniemanuelelongo@gmail.com',
                'codice_fiscale' => 'LNGGNN93P12C351O',
                'data_nascita' => Carbon::now(),
                'password' => 'prova321',
                'iban' => '535355353353',
                'banca' => 'Poste Italiane',
                'bbc' => 'prova',
                'ruolo' => 'dipendente'
            ],
        ];
        foreach($skillMockList as $key => $value){
            $element = Skill::create($value);
        }

        $capo_team = null;
        $utente = null;
        foreach($mockList as $key => $value){
            $element = Dipendente::create($value);
            SkillDipendente::create([
                'id_dipendente' => $element->id_dipendente,
                'id_skill' => '1'
            ]);
            if($value['nome'] == 'Giovanni'){
                $capo_team = $element->id_dipendente;          
            }else{
                $dipendente = $element->id_dipendente;
            }
        }
        
        Team::create([
            'nome' => 'Capitan America',
            'id_capo_team' => $capo_team
        ]);
        Team::create([
            'nome' => 'Iron Man',
            'id_capo_team' => $capo_team
        ]);

        TeamDipendente::create([
            'id_dipendente' => $dipendente,
            'id_team' => '1'
        ]);
    }

}