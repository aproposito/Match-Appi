<?php

namespace Database\Seeders;

use App\Models\MatchGame;
use Illuminate\Database\Seeder;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Horarios en UTC.
     * IDs de equipos según TeamsSeeder:
     * 1=Canadá, 2=EE.UU., 3=México, 4=Alemania, 5=Arabia Saudí, 6=Argelia,
     * 7=Argentina, 8=Australia, 9=Austria, 10=Bélgica, 11=Bosnia y Herzegovina,
     * 12=Brasil, 13=Catar, 14=Chequia, 15=Colombia, 16=Costa de Marfil,
     * 17=Croacia, 18=Curazao, 19=Ecuador, 20=Egipto, 21=Escocia, 22=España,
     * 23=Francia, 24=Ghana, 25=Haití, 26=Inglaterra, 27=Irak,
     * 28=Islas de Cabo Verde, 29=Japón, 30=Jordania, 31=Marruecos, 32=Noruega,
     * 33=Nueva Zelanda, 34=Países Bajos, 35=Panamá, 36=Paraguay, 37=Portugal,
     * 38=RD Congo, 39=República de Corea, 40=RI de Irán, 41=Senegal,
     * 42=Sudáfrica, 43=Suecia, 44=Suiza, 45=Túnez, 46=Turquía, 47=Uruguay,
     * 48=Uzbekistán, 49=Polonia, 50=Nigeria, 51=Dinamarca, 52=Italia,
     * 53=Gales, 54=Georgia, 55=Rumanía, 56=Albania, 57=Israel
     */
    public function run(): void
    {
        $matches = [

            // ── JORNADA 1 ─────────────────────────────────────────────

            ['home_team_id' => 3,  'away_team_id' => 42, 'phase' => 'groups', 'match_date_time' => '2026-06-11 19:00:00'], // México vs Sudáfrica
            ['home_team_id' => 39, 'away_team_id' => 14, 'phase' => 'groups', 'match_date_time' => '2026-06-12 02:00:00'], // República de Corea vs Chequia
            ['home_team_id' => 1,  'away_team_id' => 11, 'phase' => 'groups', 'match_date_time' => '2026-06-12 19:00:00'], // Canadá vs Bosnia y Herzegovina
            ['home_team_id' => 2,  'away_team_id' => 36, 'phase' => 'groups', 'match_date_time' => '2026-06-13 01:00:00'], // EE.UU. vs Paraguay
            ['home_team_id' => 13, 'away_team_id' => 44, 'phase' => 'groups', 'match_date_time' => '2026-06-13 19:00:00'], // Catar vs Suiza
            ['home_team_id' => 12, 'away_team_id' => 31, 'phase' => 'groups', 'match_date_time' => '2026-06-13 22:00:00'], // Brasil vs Marruecos
            ['home_team_id' => 25, 'away_team_id' => 21, 'phase' => 'groups', 'match_date_time' => '2026-06-14 01:00:00'], // Haití vs Escocia
            ['home_team_id' => 8,  'away_team_id' => 46, 'phase' => 'groups', 'match_date_time' => '2026-06-14 04:00:00'], // Australia vs Turquía
            ['home_team_id' => 4,  'away_team_id' => 18, 'phase' => 'groups', 'match_date_time' => '2026-06-14 17:00:00'], // Alemania vs Curazao
            ['home_team_id' => 34, 'away_team_id' => 29, 'phase' => 'groups', 'match_date_time' => '2026-06-14 20:00:00'], // Países Bajos vs Japón
            ['home_team_id' => 16, 'away_team_id' => 19, 'phase' => 'groups', 'match_date_time' => '2026-06-14 23:00:00'], // Costa de Marfil vs Ecuador
            ['home_team_id' => 45, 'away_team_id' => 43, 'phase' => 'groups', 'match_date_time' => '2026-06-15 02:00:00'], // Túnez vs Suecia
            ['home_team_id' => 22, 'away_team_id' => 28, 'phase' => 'groups', 'match_date_time' => '2026-06-15 16:00:00'], // España vs Islas de Cabo Verde
            ['home_team_id' => 10, 'away_team_id' => 20, 'phase' => 'groups', 'match_date_time' => '2026-06-15 19:00:00'], // Bélgica vs Egipto
            ['home_team_id' => 5,  'away_team_id' => 47, 'phase' => 'groups', 'match_date_time' => '2026-06-15 22:00:00'], // Arabia Saudí vs Uruguay
            ['home_team_id' => 40, 'away_team_id' => 33, 'phase' => 'groups', 'match_date_time' => '2026-06-16 01:00:00'], // RI de Irán vs Nueva Zelanda
            ['home_team_id' => 23, 'away_team_id' => 41, 'phase' => 'groups', 'match_date_time' => '2026-06-16 19:00:00'], // Francia vs Senegal
            ['home_team_id' => 27, 'away_team_id' => 32, 'phase' => 'groups', 'match_date_time' => '2026-06-16 22:00:00'], // Irak vs Noruega
            ['home_team_id' => 7,  'away_team_id' => 6,  'phase' => 'groups', 'match_date_time' => '2026-06-17 01:00:00'], // Argentina vs Argelia
            ['home_team_id' => 9,  'away_team_id' => 30, 'phase' => 'groups', 'match_date_time' => '2026-06-17 04:00:00'], // Austria vs Jordania
            ['home_team_id' => 37, 'away_team_id' => 38, 'phase' => 'groups', 'match_date_time' => '2026-06-17 17:00:00'], // Portugal vs RD Congo
            ['home_team_id' => 26, 'away_team_id' => 17, 'phase' => 'groups', 'match_date_time' => '2026-06-17 20:00:00'], // Inglaterra vs Croacia
            ['home_team_id' => 24, 'away_team_id' => 35, 'phase' => 'groups', 'match_date_time' => '2026-06-17 23:00:00'], // Ghana vs Panamá
            ['home_team_id' => 48, 'away_team_id' => 15, 'phase' => 'groups', 'match_date_time' => '2026-06-18 02:00:00'], // Uzbekistán vs Colombia

            // ── JORNADA 2 ─────────────────────────────────────────────

            ['home_team_id' => 14, 'away_team_id' => 42, 'phase' => 'groups', 'match_date_time' => '2026-06-18 16:00:00'], // Chequia vs Sudáfrica
            ['home_team_id' => 44, 'away_team_id' => 11, 'phase' => 'groups', 'match_date_time' => '2026-06-18 19:00:00'], // Suiza vs Bosnia y Herzegovina
            ['home_team_id' => 1,  'away_team_id' => 13, 'phase' => 'groups', 'match_date_time' => '2026-06-18 22:00:00'], // Canadá vs Catar
            ['home_team_id' => 3,  'away_team_id' => 39, 'phase' => 'groups', 'match_date_time' => '2026-06-19 01:00:00'], // México vs República de Corea
            ['home_team_id' => 2,  'away_team_id' => 8,  'phase' => 'groups', 'match_date_time' => '2026-06-19 19:00:00'], // EE.UU. vs Australia
            ['home_team_id' => 21, 'away_team_id' => 31, 'phase' => 'groups', 'match_date_time' => '2026-06-19 22:00:00'], // Escocia vs Marruecos
            ['home_team_id' => 12, 'away_team_id' => 25, 'phase' => 'groups', 'match_date_time' => '2026-06-20 00:30:00'], // Brasil vs Haití
            ['home_team_id' => 46, 'away_team_id' => 36, 'phase' => 'groups', 'match_date_time' => '2026-06-20 03:00:00'], // Turquía vs Paraguay
            ['home_team_id' => 34, 'away_team_id' => 43, 'phase' => 'groups', 'match_date_time' => '2026-06-20 17:00:00'], // Países Bajos vs Suecia
            ['home_team_id' => 4,  'away_team_id' => 16, 'phase' => 'groups', 'match_date_time' => '2026-06-20 20:00:00'], // Alemania vs Costa de Marfil
            ['home_team_id' => 19, 'away_team_id' => 18, 'phase' => 'groups', 'match_date_time' => '2026-06-21 00:00:00'], // Ecuador vs Curazao
            ['home_team_id' => 45, 'away_team_id' => 29, 'phase' => 'groups', 'match_date_time' => '2026-06-21 04:00:00'], // Túnez vs Japón
            ['home_team_id' => 22, 'away_team_id' => 5,  'phase' => 'groups', 'match_date_time' => '2026-06-21 16:00:00'], // España vs Arabia Saudí
            ['home_team_id' => 10, 'away_team_id' => 40, 'phase' => 'groups', 'match_date_time' => '2026-06-21 19:00:00'], // Bélgica vs RI de Irán
            ['home_team_id' => 47, 'away_team_id' => 28, 'phase' => 'groups', 'match_date_time' => '2026-06-21 22:00:00'], // Uruguay vs Islas de Cabo Verde
            ['home_team_id' => 33, 'away_team_id' => 20, 'phase' => 'groups', 'match_date_time' => '2026-06-22 01:00:00'], // Nueva Zelanda vs Egipto
            ['home_team_id' => 7,  'away_team_id' => 9,  'phase' => 'groups', 'match_date_time' => '2026-06-22 17:00:00'], // Argentina vs Austria
            ['home_team_id' => 23, 'away_team_id' => 27, 'phase' => 'groups', 'match_date_time' => '2026-06-22 21:00:00'], // Francia vs Irak
            ['home_team_id' => 32, 'away_team_id' => 41, 'phase' => 'groups', 'match_date_time' => '2026-06-23 00:00:00'], // Noruega vs Senegal
            ['home_team_id' => 30, 'away_team_id' => 6,  'phase' => 'groups', 'match_date_time' => '2026-06-23 03:00:00'], // Jordania vs Argelia
            ['home_team_id' => 37, 'away_team_id' => 48, 'phase' => 'groups', 'match_date_time' => '2026-06-23 17:00:00'], // Portugal vs Uzbekistán
            ['home_team_id' => 26, 'away_team_id' => 24, 'phase' => 'groups', 'match_date_time' => '2026-06-23 20:00:00'], // Inglaterra vs Ghana
            ['home_team_id' => 35, 'away_team_id' => 17, 'phase' => 'groups', 'match_date_time' => '2026-06-23 23:00:00'], // Panamá vs Croacia
            ['home_team_id' => 15, 'away_team_id' => 38, 'phase' => 'groups', 'match_date_time' => '2026-06-24 02:00:00'], // Colombia vs RD Congo

            // ── JORNADA 3 (simultáneos por grupo) ─────────────────────

            ['home_team_id' => 44, 'away_team_id' => 1,  'phase' => 'groups', 'match_date_time' => '2026-06-24 19:00:00'], // Suiza vs Canadá
            ['home_team_id' => 11, 'away_team_id' => 13, 'phase' => 'groups', 'match_date_time' => '2026-06-24 19:00:00'], // Bosnia y Herzegovina vs Catar
            ['home_team_id' => 21, 'away_team_id' => 12, 'phase' => 'groups', 'match_date_time' => '2026-06-24 22:00:00'], // Escocia vs Brasil
            ['home_team_id' => 31, 'away_team_id' => 25, 'phase' => 'groups', 'match_date_time' => '2026-06-24 22:00:00'], // Marruecos vs Haití
            ['home_team_id' => 14, 'away_team_id' => 3,  'phase' => 'groups', 'match_date_time' => '2026-06-25 01:00:00'], // Chequia vs México
            ['home_team_id' => 42, 'away_team_id' => 39, 'phase' => 'groups', 'match_date_time' => '2026-06-25 01:00:00'], // Sudáfrica vs República de Corea
            ['home_team_id' => 18, 'away_team_id' => 16, 'phase' => 'groups', 'match_date_time' => '2026-06-25 20:00:00'], // Curazao vs Costa de Marfil
            ['home_team_id' => 19, 'away_team_id' => 4,  'phase' => 'groups', 'match_date_time' => '2026-06-25 20:00:00'], // Ecuador vs Alemania
            ['home_team_id' => 29, 'away_team_id' => 43, 'phase' => 'groups', 'match_date_time' => '2026-06-25 23:00:00'], // Japón vs Suecia
            ['home_team_id' => 45, 'away_team_id' => 34, 'phase' => 'groups', 'match_date_time' => '2026-06-25 23:00:00'], // Túnez vs Países Bajos
            ['home_team_id' => 46, 'away_team_id' => 2,  'phase' => 'groups', 'match_date_time' => '2026-06-26 02:00:00'], // Turquía vs EE.UU.
            ['home_team_id' => 36, 'away_team_id' => 8,  'phase' => 'groups', 'match_date_time' => '2026-06-26 02:00:00'], // Paraguay vs Australia
            ['home_team_id' => 32, 'away_team_id' => 23, 'phase' => 'groups', 'match_date_time' => '2026-06-26 19:00:00'], // Noruega vs Francia
            ['home_team_id' => 41, 'away_team_id' => 27, 'phase' => 'groups', 'match_date_time' => '2026-06-26 19:00:00'], // Senegal vs Irak
            ['home_team_id' => 28, 'away_team_id' => 5,  'phase' => 'groups', 'match_date_time' => '2026-06-27 00:00:00'], // Islas de Cabo Verde vs Arabia Saudí
            ['home_team_id' => 47, 'away_team_id' => 22, 'phase' => 'groups', 'match_date_time' => '2026-06-27 00:00:00'], // Uruguay vs España
            ['home_team_id' => 20, 'away_team_id' => 40, 'phase' => 'groups', 'match_date_time' => '2026-06-27 03:00:00'], // Egipto vs RI de Irán
            ['home_team_id' => 33, 'away_team_id' => 10, 'phase' => 'groups', 'match_date_time' => '2026-06-27 03:00:00'], // Nueva Zelanda vs Bélgica
            ['home_team_id' => 35, 'away_team_id' => 26, 'phase' => 'groups', 'match_date_time' => '2026-06-27 21:00:00'], // Panamá vs Inglaterra
            ['home_team_id' => 17, 'away_team_id' => 24, 'phase' => 'groups', 'match_date_time' => '2026-06-27 21:00:00'], // Croacia vs Ghana
            ['home_team_id' => 15, 'away_team_id' => 37, 'phase' => 'groups', 'match_date_time' => '2026-06-27 23:30:00'], // Colombia vs Portugal
            ['home_team_id' => 38, 'away_team_id' => 48, 'phase' => 'groups', 'match_date_time' => '2026-06-27 23:30:00'], // RD Congo vs Uzbekistán
            ['home_team_id' => 6,  'away_team_id' => 9,  'phase' => 'groups', 'match_date_time' => '2026-06-28 02:00:00'], // Argelia vs Austria
            ['home_team_id' => 30, 'away_team_id' => 7,  'phase' => 'groups', 'match_date_time' => '2026-06-28 02:00:00'], // Jordania vs Argentina

            // ── PARTIDOS DE PRUEBA ─────────────────────────────────────
            // (IDs corregidos según TeamsSeeder)
            // Eliminados: partidos con Madagascar, Luxemburgo, Guatemala y Serbia
            // (equipos no incluidos en TeamsSeeder)

            ['home_team_id' => 17, 'away_team_id' => 10, 'phase' => 'groups', 'match_date_time' => '2026-06-02 16:00:00'], // Croacia vs Bélgica
            ['home_team_id' => 54, 'away_team_id' => 55, 'phase' => 'groups', 'match_date_time' => '2026-06-02 17:00:00'], // Georgia vs Rumanía
            ['home_team_id' => 53, 'away_team_id' => 24, 'phase' => 'groups', 'match_date_time' => '2026-06-02 18:45:00'], // Gales vs Ghana
            ['home_team_id' => 25, 'away_team_id' => 33, 'phase' => 'groups', 'match_date_time' => '2026-06-03 00:00:00'], // Haití vs Nueva Zelanda
            ['home_team_id' => 56, 'away_team_id' => 57, 'phase' => 'groups', 'match_date_time' => '2026-06-03 18:00:00'], // Albania vs Israel
            ['home_team_id' => 38, 'away_team_id' => 51, 'phase' => 'groups', 'match_date_time' => '2026-06-03 18:00:00'], // RD Congo vs Dinamarca
            ['home_team_id' => 34, 'away_team_id' => 6,  'phase' => 'groups', 'match_date_time' => '2026-06-03 18:45:00'], // Países Bajos vs Argelia
            ['home_team_id' => 49, 'away_team_id' => 50, 'phase' => 'groups', 'match_date_time' => '2026-06-03 18:45:00'], // Polonia vs Nigeria
            ['home_team_id' => 22, 'away_team_id' => 27, 'phase' => 'groups', 'match_date_time' => '2026-06-04 19:00:00'], // España vs Irak
            ['home_team_id' => 15, 'away_team_id' => 30, 'phase' => 'groups', 'match_date_time' => '2026-06-09 02:00:00'], // Colombia vs Jordania
        ];

        MatchGame::insert($matches);
        // Partidos "demo": fechas relativas a hoy para que el user vea contenido
        // en cualquier día que se pruebe la app (ventana de GET /matches).
        $demoMatches = [
            // Terminado ayer, con resultado → alimenta ranking e historial
            [
                'home_team_id' => 22,
                'away_team_id' => 23,
                'phase' => 'groups',
                'match_date_time' => now()->subDay()->format('Y-m-d H:i:s'),
                'final_home_goals' => 2,
                'final_away_goals' => 1,
            ],
            // Por jugar hoy → el user lo ve y puede apostar
                       [
                'home_team_id' => 7,
                'away_team_id' => 37,
                'phase' => 'groups',
                'match_date_time' => now()->addHours(3)->format('Y-m-d H:i:s'),
                'final_home_goals' => null,
                'final_away_goals' => null,
            ],
            [
                'home_team_id' => 12,
                'away_team_id' => 34,
                'phase' => 'groups',
                'match_date_time' => now()->addHours(6)->format('Y-m-d H:i:s'),
                'final_home_goals' => null,
                'final_away_goals' => null,
            ],
        ];
                MatchGame::insert($demoMatches);
    }
}
