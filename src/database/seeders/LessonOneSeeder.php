<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Seeder;

class LessonOneSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'agamedov94@mail.ru'],
            ['name' => 'Murad', 'password' => bcrypt('password123')]
        );

        $group = Group::firstOrCreate(
            ['user_id' => $user->id, 'name' => 'Lesson 1'],
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
            ['aghi', 'aqi', 'iynələr'],
            ['anche', 'anke', 'də, həmçinin'],
            ['appartamento', 'appartamento', 'mənzil'],
            ['bacio', 'baço', 'öpüş'],
            ['bagno', 'banyo', 'vanna otağı'],
            ['bella / bello', 'bella / bello', 'gözəl'],
            ['benzina', 'bendzina', 'benzin'],
            ['Bologna', 'Bolonya', 'Bolonya (şəhər)'],
            ['caffè', 'kaffE', 'qəhvə'],
            ['calze', 'kaltse', 'corablar'],
            ['caro', 'karo', 'əziz; bahalı'],
            ['carro', 'karro', 'araba'],
            ['casa', 'kaza', 'ev'],
            ['cena', 'çena', 'şam yeməyi'],
            ['che', 'ke', 'nə; ki'],
            ['chi', 'ki', 'kim'],
            ['chitarra', 'kitarra', 'gitara'],
            ['ciao', 'çao', 'salam; hələlik'],
            ['cinema', 'çinema', 'kino'],
            ['città', 'çittA', 'şəhər'],
            ['ciuffo', 'çuffo', 'kəkil, saç tutamı'],
            ['cliente', 'kliente', 'müştəri'],
            ['cominciamo', 'kominçamo', 'başlayaq'],
            ['compagno', 'kompanyo', 'yoldaş'],
            ['comunità', 'komunitA', 'icma'],
            ['conto', 'konto', 'hesab'],
            ['cosa', 'koza', 'şey; nə'],
            ['crema', 'krema', 'krem'],
            ['cura', 'kura', 'qayğı; müalicə'],
            ['cuscino', 'kuşino', 'yastıq'],
            ['divano', 'divano', 'divan'],
            ['enigma', 'eniqma', 'tapmaca, sirr'],
            ['esclamare', 'esklamare', 'nida etmək, qışqırmaq'],
            ['esercizio', 'ezerçitsio', 'tapşırıq, məşq'],
            ['figli', 'filyi', 'övladlar, oğullar'],
            ['figlia', 'filya', 'qız (övlad)'],
            ['figlio', 'filyo', 'oğul'],
            ['gatto', 'qatto', 'pişik'],
            ['gente', 'cente', 'insanlar, camaat'],
            ['ghetto', 'qetto', 'getto'],
            ['ghirlanda', 'qirlanda', 'çələng'],
            ['giallo', 'callo', 'sarı'],
            ['giorno', 'corno', 'gün'],
            ['giustizia', 'custitsia', 'ədalət'],
            ['glicerina', 'qliçerina', 'qliserin'],
            ['gloria', 'qloria', 'şöhrət'],
            ['governo', 'qoverno', 'hökumət'],
            ['grande', 'qrande', 'böyük'],
            ['gusto', 'qusto', 'dad; zövq'],
            ['hotel', 'otel', 'otel'],
            ['jeans', 'cins', 'cins şalvar'],
            ['kiwi', 'kivi', 'kivi'],
            ['largo', 'larqo', 'geniş, enli'],
            ['letto', 'letto', 'çarpayı'],
            ['lezione', 'letsione', 'dərs'],
            ['limone', 'limone', 'limon'],
            ['lungo', 'lunqo', 'uzun'],
            ['mamma mia!', 'mamma mia', 'Aman Allah! (nida)'],
            ['marzo', 'martso', 'mart'],
            ['mimosa', 'mimoza', 'mimoza (gül)'],
            ['moglie', 'molye', 'arvad, həyat yoldaşı'],
            ['mozzarella', 'mottsarella', 'motsarella (pendir)'],
            ['negligenza', 'neqlicentsa', 'səhlənkarlıq'],
            ['nona', 'nona', 'doqquzuncu'],
            ['nonna', 'nonna', 'nənə'],
            ['oggi', 'occi', 'bu gün'],
            ['ogni', 'onyi', 'hər'],
            ['organizzare', 'orqaniddzare', 'təşkil etmək'],
            ['pensare', 'pensare', 'düşünmək'],
            ['perché', 'perkE', 'niyə; çünki'],
            ['pesce', 'peşe', 'balıq'],
            ['pezzo', 'pettso', 'parça, tikə'],
            ['pizza', 'pittsa', 'pitsa'],
            ['pomodoro', 'pomodoro', 'pomidor'],
            ['pozzo', 'pottso', 'quyu'],
            ['prosciutto', 'proşutto', 'qurudulmuş vetçina'],
            ['quadro', 'kuadro', 'tablo, şəkil'],
            ['quasi', 'kuazi', 'demək olar ki'],
            ['risposta', 'risposta', 'cavab'],
            ['rosa', 'roza', 'qızılgül; çəhrayı'],
            ['rosso', 'rosso', 'qırmızı'],
            ['russo', 'russo', 'rus'],
            ['sapere', 'sapere', 'bilmək'],
            ['sbaglio', 'zbalyo', 'səhv'],
            ['scala', 'skala', 'pilləkən'],
            ['scena', 'şena', 'səhnə'],
            ['scendere', 'şendere', 'enmək'],
            ['schiavo', 'skiavo', 'qul'],
            ['schiuma', 'skiuma', 'köpük'],
            ['sciarpa', 'şarpa', 'şərf'],
            ['sciopero', 'şopero', 'tətil (iş tətili)'],
            ['scopo', 'skopo', 'məqsəd'],
            ['scrivere', 'skrivere', 'yazmaq'],
            ['scuola', 'skuola', 'məktəb'],
            ['scuro', 'skuro', 'tünd, qaranlıq'],
            ['sdegno', 'zdenyo', 'qəzəb, hiddət'],
            ['sera', 'sera', 'axşam'],
            ['sfera', 'sfera', 'kürə'],
            ['sgombero', 'zqombero', 'boşaltma, köçmə'],
            ['sicurezza', 'sikurettsa', 'təhlükəsizlik'],
            ['simpatizzare', 'simpatiddzare', 'rəğbət bəsləmək'],
            ['slavo', 'zlavo', 'slavyan'],
            ['smettere', 'zmettere', 'dayandırmaq, əl çəkmək'],
            ['snello', 'znello', 'incə, arıq (bədən)'],
            ['sole', 'sole', 'günəş'],
            ['spaghetti', 'spaqetti', 'spagetti'],
            ['squadra', 'skuadra', 'komanda'],
            ['steppa', 'steppa', 'çöl'],
            ['succo', 'sukko', 'şirə'],
            ['svedese', 'zvedeze', 'isveçli'],
            ['tedesco', 'tedesko', 'alman'],
            ['uscire', 'uşire', 'çıxmaq'],
            ['xerocopia', 'kserokopia', 'surət, kserokopiya'],
            ['yogurt', 'yoqurt', 'yoqurt'],
            ['zero', 'dzero', 'sıfır'],
            ['zia', 'tsia', 'xala, bibi'],
            ['zio', 'tsio', 'dayı, əmi'],
            ['zolfo', 'tsolfo', 'kükürd'],
            ['zona', 'dzona', 'zona, ərazi'],
            ['zuppa', 'tsuppa', 'şorba'],
        ];
    }
}
