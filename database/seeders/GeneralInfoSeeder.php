<?php

namespace Database\Seeders;

use App\Models\GeneralInfo;
use DateTimeImmutable;
use Illuminate\Database\Seeder;

class GeneralInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataInit = new DateTimeImmutable('2023-05-09');
        $dataToday = new DateTimeImmutable();

        GeneralInfo::factory()->create([
            'name' => 'Carlos Alexandre',
            'email' => 'dev@carlosalexandre.com.br',
            'title' => 'Desenvolvedor Full-Stack',
            'bio' => 'Oi! Sou o Carlos Alexandre, programador full-stack apaixonado por transformar ideias em sistemas web que realmente funcionam. Trabalho com PHP, Laravel, MySQL e JavaScript — sempre buscando o melhor equilíbrio entre código limpo, performance e praticidade. Se você precisa de alguém pra tirar seu projeto do papel, me chama que tô aberto a freelas',
            'location' => 'São Paulo/SP',
            'timezone' => 'America/Sao_Paulo',
            'experience_years' => $dataToday->diff($dataInit)->y,
            'freelance_available' => true,
        ]);
    }
}
