<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Seeder;

class LessonThreeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'agamedov94@mail.ru'],
            ['name' => 'Murad', 'password' => bcrypt('password123')]
        );

        $group = Group::firstOrCreate(
            ['user_id' => $user->id, 'name' => 'Lezione 3'],
        );

        foreach ($this->words() as [$original, $pronunciation, $translation]) {
            Word::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'group_id' => $group->id,
                    'original' => $original,
                ],
                [
                    'pronunciation' => $pronunciation,
                    'translation' => $translation,
                ]
            );
        }
    }

    /**
     * @return array<int, array{0: string, 1: string, 2: string}>
     */
    private function words(): array
    {
        return [
            ['bandito', 'bandito', 'quldur, bandit'],
            ['teatro', 'teatro', 'teatr'],
            ['porto', 'porto', 'liman'],
            ['soldato', 'soldato', 'əsgər'],
            ['scandalo', 'skandalo', 'qalmaqal, skandal'],
            ['telefono', 'telefono', 'telefon'],
            ['aeroporto', 'aeroporto', 'aeroport'],
            ['capitano', 'kapitano', 'kapitan'],
            ['tipo', 'tipo', 'tip; adam'],
            ['parlamento', 'parlamento', 'parlament'],
            ['termometro', 'termometro', 'termometr'],
            ['temperamento', 'temperamento', 'temperament'],
            ['documento', 'dokumento', 'sənəd'],
            ['monumento', 'monumento', 'abidə'],
            ['complimento', 'komplimento', 'kompliment'],
            ['vulcano', 'vulkano', 'vulkan'],
            ['uragano', 'uraqano', 'qasırğa'],
            ['ministro', 'ministro', 'nazir'],
            ['contratto', 'kontratto', 'müqavilə'],
            ['diavolo', 'diavolo', 'şeytan'],
            ['cretino', 'kretino', 'axmaq, gicbəsər'],
            ['aperitivo', 'aperitivo', 'aperitiv (yeməkdən əvvəl içki)'],
            ['contatto', 'kontatto', 'əlaqə, təmas'],
            ['greco', 'greko', 'yunan (kişi)'],
            ['visita', 'vizita', 'ziyarət; müayinə'],
            ['orchestra', 'orkestra', 'orkestr'],
            ['banana', 'banana', 'banan'],
            ['greca', 'greka', 'yunan (qadın)'],
            ['torta', 'torta', 'tort'],
            ['vitamina', 'vitamina', 'vitamin'],
            ['pasta', 'pasta', 'makaron; xəmir'],
            ['commedia', 'kommedia', 'komediya'],
            ['frutta', 'frutta', 'meyvə'],
            ['sigaretta', 'siqaretta', 'siqaret'],
            ['copia', 'kopia', 'nüsxə, surət'],
            ['tragedia', 'tracedia', 'faciə, tragediya'],
            ['cometa', 'kometa', 'kometa'],
            ['caricatura', 'karikatura', 'karikatura'],
            ['cultura', 'kultura', 'mədəniyyət'],
            ['nota', 'nota', 'qeyd; not'],
            ['americana', 'amerikana', 'amerikalı (qadın)'],
            ['scultura', 'skultura', 'heykəl; heykəltəraşlıq'],
            ['lampada', 'lampada', 'lampa'],
            ['italiana', 'italiana', 'italyan (qadın)'],
            ['storia', 'storia', 'tarix; hekayə'],
            ['candidatura', 'kandidatura', 'namizədlik'],
            ['studentessa', 'studentessa', 'tələbə (qız)'],
            ['persona', 'persona', 'şəxs, adam'],
            ['professoressa', 'professoressa', 'müəllimə, professor (qadın)'],
            ['metropolitana', 'metropolitana', 'metro'],
            ['motore', 'motore', 'mühərrik'],
            ['pastore', 'pastore', 'çoban'],
            ['terrore', 'terrore', 'dəhşət, terror'],
            ['presidente', 'prezidente', 'prezident, sədr'],
            ['dottore', 'dottore', 'həkim, doktor'],
            ['professore', 'professore', 'müəllim, professor'],
            ['diabete', 'diabete', 'diabet'],
            ['studente', 'studente', 'tələbə'],
            ['padre', 'padre', 'ata'],
            ['fame', 'fame', 'aclıq'],
            ['regione', 'recone', 'region, bölgə'],
            ['madre', 'madre', 'ana'],
            ['stazione', 'statsione', 'stansiya, vağzal'],
            ['pensione', 'pensione', 'pensiya; pansion'],
            ['specie', 'speçe', 'növ'],
            ['origine', 'oricine', 'mənşə, mənbə'],
            ['melo', 'melo', 'alma ağacı'],
            ['mela', 'mela', 'alma'],
            ['pero', 'pero', 'armud ağacı'],
            ['pera', 'pera', 'armud'],
            ['arancio', 'aranço', 'portağal ağacı'],
            ['arancia', 'arança', 'portağal'],
            ['ciliegio', 'çilieco', 'albalı (gilas) ağacı'],
            ['ciliegia', 'çilieca', 'albalı (gilas)'],
            ['castagno', 'kastanyo', 'şabalıd ağacı'],
            ['castagna', 'kastanya', 'şabalıd'],
            ['papa', 'papa', 'Roma papası'],
            ['papà', 'papa', 'ata, baba'],
            ['mano', 'mano', 'əl'],
            ['foto', 'foto', 'foto, şəkil'],
            ['problema', 'problema', 'problem'],
            ['pirata', 'pirata', 'quldur, pirat'],
            ['monarca', 'monarka', 'monarx'],
            ['brindisi', 'brindizi', 'badə qaldırma, tost'],
            ['crisi', 'krizi', 'böhran'],
            ['sofà', 'sofa', 'divan'],
            ['bambù', 'bambu', 'bambuk'],
            ['libertà', 'liberta', 'azadlıq'],
            ['gioventù', 'coventu', 'gənclik'],
            ['sport', 'sport', 'idman'],
            ['autobus', 'autobus', 'avtobus'],
            ['filobus', 'filobus', 'trolleybus'],
        ];
    }
}
