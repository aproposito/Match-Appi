<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['name' => 'Canadá', 'flag' => 'https://flagcdn.com/ca.svg'],
            ['name' => 'EE. UU.', 'flag' => 'https://flagcdn.com/us.svg'],
            ['name' => 'México', 'flag' => 'https://flagcdn.com/mx.svg'],
            ['name' => 'Alemania', 'flag' => 'https://flagcdn.com/de.svg'],
            ['name' => 'Arabia Saudí', 'flag' => 'https://flagcdn.com/sa.svg'],
            ['name' => 'Argelia', 'flag' => 'https://flagcdn.com/dz.svg'],
            ['name' => 'Argentina', 'flag' => 'https://flagcdn.com/ar.svg'],
            ['name' => 'Australia', 'flag' => 'https://flagcdn.com/au.svg'],
            ['name' => 'Austria', 'flag' => 'https://flagcdn.com/at.svg'],
            ['name' => 'Bélgica', 'flag' => 'https://flagcdn.com/be.svg'],
            ['name' => 'Bosnia y Herzegovina', 'flag' => 'https://flagcdn.com/ba.svg'],
            ['name' => 'Brasil', 'flag' => 'https://flagcdn.com/br.svg'],
            ['name' => 'Catar', 'flag' => 'https://flagcdn.com/qa.svg'],
            ['name' => 'Chequia', 'flag' => 'https://flagcdn.com/cz.svg'],
            ['name' => 'Colombia', 'flag' => 'https://flagcdn.com/co.svg'],
            ['name' => 'Costa de Marfil', 'flag' => 'https://flagcdn.com/ci.svg'],
            ['name' => 'Croacia', 'flag' => 'https://flagcdn.com/hr.svg'],
            ['name' => 'Curazao', 'flag' => 'https://flagcdn.com/cw.svg'],
            ['name' => 'Ecuador', 'flag' => 'https://flagcdn.com/ec.svg'],
            ['name' => 'Egipto', 'flag' => 'https://flagcdn.com/eg.svg'],
            ['name' => 'Escocia', 'flag' => 'https://flagcdn.com/gb-sct.svg'],
            ['name' => 'España', 'flag' => 'https://flagcdn.com/es.svg'],
            ['name' => 'Francia', 'flag' => 'https://flagcdn.com/fr.svg'],
            ['name' => 'Ghana', 'flag' => 'https://flagcdn.com/gh.svg'],
            ['name' => 'Haití', 'flag' => 'https://flagcdn.com/ht.svg'],
            ['name' => 'Inglaterra', 'flag' => 'https://flagcdn.com/gb-eng.svg'],
            ['name' => 'Irak', 'flag' => 'https://flagcdn.com/iq.svg'],
            ['name' => 'Islas de Cabo Verde', 'flag' => 'https://flagcdn.com/cv.svg'],
            ['name' => 'Japón', 'flag' => 'https://flagcdn.com/jp.svg'],
            ['name' => 'Jordania', 'flag' => 'https://flagcdn.com/jo.svg'],
            ['name' => 'Marruecos', 'flag' => 'https://flagcdn.com/ma.svg'],
            ['name' => 'Noruega', 'flag' => 'https://flagcdn.com/no.svg'],
            ['name' => 'Nueva Zelanda', 'flag' => 'https://flagcdn.com/nz.svg'],
            ['name' => 'Países Bajos', 'flag' => 'https://flagcdn.com/nl.svg'],
            ['name' => 'Panamá', 'flag' => 'https://flagcdn.com/pa.svg'],
            ['name' => 'Paraguay', 'flag' => 'https://flagcdn.com/py.svg'],
            ['name' => 'Portugal', 'flag' => 'https://flagcdn.com/pt.svg'],
            ['name' => 'RD Congo', 'flag' => 'https://flagcdn.com/cd.svg'],
            ['name' => 'República de Corea', 'flag' => 'https://flagcdn.com/kr.svg'],
            ['name' => 'RI de Irán', 'flag' => 'https://flagcdn.com/ir.svg'],
            ['name' => 'Senegal', 'flag' => 'https://flagcdn.com/sn.svg'],
            ['name' => 'Sudáfrica', 'flag' => 'https://flagcdn.com/za.svg'],
            ['name' => 'Suecia', 'flag' => 'https://flagcdn.com/se.svg'],
            ['name' => 'Suiza', 'flag' => 'https://flagcdn.com/ch.svg'],
            ['name' => 'Túnez', 'flag' => 'https://flagcdn.com/tn.svg'],
            ['name' => 'Turquía', 'flag' => 'https://flagcdn.com/tr.svg'],
            ['name' => 'Uruguay', 'flag' => 'https://flagcdn.com/uy.svg'],
            ['name' => 'Uzbekistán', 'flag' => 'https://flagcdn.com/uz.svg'],
            ['name' => 'Polonia', 'flag' => 'https://flagcdn.com/pl.svg'],

            
            ['name' => 'Nigeria', 'flag' => 'https://flagcdn.com/ng.svg'],
            ['name' => 'Dinamarca', 'flag' => 'https://flagcdn.com/dk.svg'],
            ['name' => 'Italia', 'flag' => 'https://flagcdn.com/it.svg'],
            ['name' => 'Gales', 'flag' => 'https://flagcdn.com/gb-wls.svg'],
            ['name' => 'Georgia', 'flag' => 'https://flagcdn.com/ge.svg'],
            ['name' => 'Rumanía', 'flag' => 'https://flagcdn.com/ro.svg'],
            ['name' => 'Albania', 'flag' => 'https://flagcdn.com/al.svg'],
            ['name' => 'Israel', 'flag' => 'https://flagcdn.com/il.svg'],

          
        ];
        DB::table('teams')->insert($teams);
    }
}
