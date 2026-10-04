<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Seeder;

class LessonTwoSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'agamedov94@mail.ru'],
            ['name' => 'Murad', 'password' => bcrypt('password123')]
        );

        $group = Group::firstOrCreate(
            ['user_id' => $user->id, 'name' => 'Lesson 2'],
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
            ['riposare', 'ripozare', 'dincəlmək'],
            ['nervoso', 'nervozo', 'əsəbi'],
            ['cassa', 'kassa', 'kassa, sandıq'],
            ['classe', 'klasse', 'sinif'],
            ['tassa', 'tassa', 'vergi, haqq'],
            ['frase', 'fraze', 'cümlə'],
            ['grasso', 'qrasso', 'yağlı; piy'],
            ['sviluppare', 'zviluppare', 'inkişaf etdirmək'],
            ['slitta', 'zlitta', 'xizək'],
            ['sconto', 'skonto', 'endirim'],
            ['svago', 'zvaqo', 'istirahət, əyləncə'],
            ['sale', 'sale', 'duz'],
            ['solo', 'solo', 'yalnız, tək'],
            ['sempre', 'sempre', 'həmişə'],
            ['presto', 'presto', 'tez'],
            ['borsa', 'borsa', 'çanta'],
            ['permesso', 'permesso', 'icazə'],
            ['corso', 'korso', 'kurs'],
            ['signora', 'sinyora', 'xanım'],
            ['signore', 'sinyore', 'cənab'],
            ['montagna', 'montanya', 'dağ'],
            ['insegnare', 'insenyare', 'öyrətmək'],
            ['giugno', 'cunyo', 'iyun'],
            ['famiglia', 'familya', 'ailə'],
            ['bottiglia', 'bottilya', 'şüşə (butulka)'],
            ['tovaglia', 'tovalya', 'süfrə'],
            ['portafoglio', 'portafolyo', 'pul kisəsi'],
            ['foglio', 'folyo', 'vərəq'],
            ['prezzo', 'prettso', 'qiymət'],
            ['indirizzo', 'indirittso', 'ünvan'],
            ['piazza', 'piattsa', 'meydan'],
            ['ragazza', 'raqattsa', 'qız'],
            ['bellezza', 'bellettsa', 'gözəllik'],
            ['forza', 'fortsa', 'güc'],
            ['pranzo', 'prandzo', 'nahar'],
            ['vacanza', 'vakantsa', 'tətil'],
            ['inizio', 'initsio', 'başlanğıc'],
            ['silenzio', 'silentsio', 'sükut'],
            ['attenzione', 'attentsione', 'diqqət'],
            ['zaino', 'dzaino', 'bel çantası (məktəb çantası)'],
            ['zucchero', 'tsukkero', 'şəkər'],
            ['zucchini', 'tsukkini', 'kabak (tsukkini)'],
            ['realizzare', 'realiddzare', 'həyata keçirmək'],
            ['scimmia', 'şimmia', 'meymun'],
            ['scivolare', 'şivolare', 'sürüşmək'],
            ['scemo', 'şemo', 'sadəlövh, axmaq'],
            ['finisco', 'finisko', 'qurtarıram, bitirirəm'],
            ['scherzo', 'skertso', 'zarafat'],
            ['nonno', 'nonno', 'baba'],
            ['fratello', 'fratello', 'qardaş'],
            ['sorella', 'sorella', 'bacı'],
            ['mattina', 'mattina', 'səhər'],
            ['pittore', 'pittore', 'rəssam'],
            ['brutto', 'brutto', 'çirkin, pis'],
            ['freddo', 'freddo', 'soyuq'],
            ['cattivo', 'kattivo', 'pis, bədxah'],
            ['studiare', 'studiare', 'oxumaq, öyrənmək'],
            ['straniero', 'straniero', 'əcnəbi'],
            ['sedia', 'sedia', 'stul'],
            ['insieme', 'insieme', 'birlikdə'],
            ['piano', 'piano', 'yavaş; mərtəbə'],
            ['fiume', 'fyume', 'çay (irmaq)'],
            ['qui', 'kui', 'burada'],
            ['qua', 'kua', 'bura'],
            ['quaderno', 'kuaderno', 'dəftər'],
            ['questo', 'kuesto', 'bu'],
            ['quello', 'kuello', 'o'],
            ['frequentare', 'frekuentare', 'davam etmək (dərsə və s.)'],
            ['pane', 'pane', 'çörək'],
            ['cane', 'kane', 'it'],
            ['camera', 'kamera', 'otaq'],
            ['poco', 'poko', 'az'],
            ['banca', 'banka', 'bank'],
            ['ricordare', 'rikordare', 'xatırlamaq'],
            ['gonna', 'qonna', 'yubka'],
            ['penna', 'penna', 'qələm'],
            ['treno', 'treno', 'qatar'],
            ['vaso', 'vazo', 'vaza'],
            ['naso', 'nazo', 'burun'],
            ['caldo', 'kaldo', 'isti'],
            ['albergo', 'alberqo', 'otel'],
            ['piccolo', 'pikkolo', 'kiçik'],
            ['giornale', 'cornale', 'qəzet'],
            ['giusto', 'custo', 'düzgün, haqlı'],
            ['giacca', 'cakka', 'gödəkçə, pencək'],
            ['pomeriggio', 'pomericcio', 'günortadan sonra'],
            ['viaggio', 'viaccio', 'səyahət'],
            ['giardino', 'cardino', 'bağ'],
            ['valigia', 'valica', 'çamadan'],
            ['formaggio', 'formaccio', 'pendir'],
            ['gelato', 'celato', 'dondurma'],
            ['gentile', 'centile', 'mehriban, nəzakətli'],
            ['intelligente', 'intellicente', 'zəkalı, ağıllı'],
            ['genitori', 'cenitori', 'valideynlər'],
            ['cugino', 'kucino', 'əmioğlu (kişi qohum)'],
            ['cugina', 'kucina', 'əmiqızı (qadın qohum)'],
            ['funghi', 'funqi', 'göbələklər'],
            ['ghiaccio', 'qyaccio', 'buz'],
            ['margherita', 'marqerita', 'çobanyastığı (çiçək)'],
        ];
    }
}
