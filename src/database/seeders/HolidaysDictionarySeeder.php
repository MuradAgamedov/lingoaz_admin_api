<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use App\Models\DictionaryCategory;
use Illuminate\Database\Seeder;

class HolidaysDictionarySeeder extends Seeder
{
    public function run(): void
    {
        $category = DictionaryCategory::where('title', 'Holidays')->first();

        if (!$category) {
            $category = DictionaryCategory::create([
                'title' => 'Holidays',
            ]);
        }

        $words = [

            // General phrases
            ['word' => 'be on holiday', 'translation' => 'tətildə olmaq'],
            ['word' => 'be on vacation', 'translation' => 'məzuniyyətdə olmaq'],
            ['word' => 'make friends', 'translation' => 'dostlaşmaq'],
            ['word' => 'have a wonderful time', 'translation' => 'əla vaxt keçirmək'],
            ['word' => 'take pictures of', 'translation' => 'şəklini çəkmək'],
            ['word' => 'enjoy', 'translation' => 'zövq almaq'],

            // Sightseeing holidays
            ['word' => 'travel round Europe', 'translation' => 'Avropa boyunca səyahət etmək'],
            ['word' => 'travel round Great Britain', 'translation' => 'Böyük Britaniya boyunca səyahət etmək'],
            ['word' => 'travel by car', 'translation' => 'maşınla səyahət etmək'],
            ['word' => 'travel by plane', 'translation' => 'təyyarə ilə səyahət etmək'],
            ['word' => 'travel by train', 'translation' => 'qatarla səyahət etmək'],
            ['word' => 'travel by bus', 'translation' => 'avtobusla səyahət etmək'],
            ['word' => 'go abroad', 'translation' => 'xaricə getmək'],
            ['word' => 'go on a trip', 'translation' => 'səfərə çıxmaq'],
            ['word' => 'walk the streets', 'translation' => 'küçələrdə gəzmək'],
            ['word' => 'visit places on the way', 'translation' => 'yolda yerləri ziyarət etmək'],
            ['word' => 'see interesting places', 'translation' => 'maraqlı yerləri görmək'],
            ['word' => 'meet different people', 'translation' => 'fərqli insanlarla tanış olmaq'],
            ['word' => 'visit museums and art galleries', 'translation' => 'muzey və incəsənət qalereyalarını ziyarət etmək'],
            ['word' => 'stay at a hotel', 'translation' => 'oteldə qalmaq'],
            ['word' => 'enjoy the beauty of the scenery', 'translation' => 'təbiətin gözəlliyindən zövq almaq'],

            // Seaside holidays
            ['word' => 'go to the beach', 'translation' => 'çimərliyə getmək'],
            ['word' => 'go to the seaside', 'translation' => 'dəniz kənarına getmək'],
            ['word' => 'sit on the sand', 'translation' => 'qumda oturmaq'],
            ['word' => 'look at the sea', 'translation' => 'dənizə baxmaq'],
            ['word' => 'look at the clouds floating in the sky', 'translation' => 'göydə üzən buludlara baxmaq'],
            ['word' => 'spend time on the beach', 'translation' => 'çimərlikdə vaxt keçirmək'],
            ['word' => 'bathe in the river', 'translation' => 'çayda çimmək'],
            ['word' => 'lie in the sun', 'translation' => 'günəşlənmək'],
            ['word' => 'play football', 'translation' => 'futbol oynamaq'],
            ['word' => 'play volleyball', 'translation' => 'voleybol oynamaq'],
            ['word' => 'fly a kite', 'translation' => 'uçurtma uçurtmaq'],
            ['word' => 'build sand castles', 'translation' => 'qumdan qala tikmək'],
            ['word' => 'play in the sand', 'translation' => 'qumda oynamaq'],
            ['word' => 'look for shells', 'translation' => 'dəniz qabığı axtarmaq'],

            // Holidays at grandparents
            ['word' => 'go for a walk in the forest', 'translation' => 'meşədə gəzməyə çıxmaq'],
            ['word' => 'pick up berries', 'translation' => 'giləmeyvə toplamaq'],
            ['word' => 'pick up mushrooms', 'translation' => 'göbələk toplamaq'],
            ['word' => 'ride a horse', 'translation' => 'ata minmək'],
            ['word' => 'ride a bicycle', 'translation' => 'velosiped sürmək'],
            ['word' => 'go boating', 'translation' => 'qayıqla gəzmək'],
            ['word' => 'go fishing', 'translation' => 'balıq tutmağa getmək'],
            ['word' => 'catch fish', 'translation' => 'balıq tutmaq'],
            ['word' => 'read a book under a tree', 'translation' => 'ağac altında kitab oxumaq'],
            ['word' => 'take long walks with friends', 'translation' => 'dostlarla uzun gəzintilər etmək'],
            ['word' => 'help grandparents in the garden', 'translation' => 'bağda nənə və babaya kömək etmək'],
            ['word' => 'dig the ground', 'translation' => 'torpaq qazmaq'],
            ['word' => 'pull out the weeds', 'translation' => 'alaqları təmizləmək'],
            ['word' => 'pick up fruit', 'translation' => 'meyvə toplamaq'],
            ['word' => 'take care of domestic animals', 'translation' => 'ev heyvanlarına qulluq etmək'],
            ['word' => 'eat healthy food', 'translation' => 'sağlam qida yemək'],
            ['word' => 'spend time outdoors', 'translation' => 'açıq havada vaxt keçirmək'],

            // Camping holidays
            ['word' => 'go to a summer camp', 'translation' => 'yay düşərgəsinə getmək'],
            ['word' => 'go camping', 'translation' => 'kampinqə getmək'],
            ['word' => 'climb the mountains', 'translation' => 'dağlara dırmaşmaq'],
            ['word' => 'fish by the river', 'translation' => 'çay kənarında balıq tutmaq'],
            ['word' => 'make a campfire', 'translation' => 'tonqal qalamaq'],
            ['word' => 'sit round the fire', 'translation' => 'odun ətrafında oturmaq'],
            ['word' => 'roast sausages on the fire', 'translation' => 'oddə sosiska qızartmaq'],
            ['word' => 'swim in the river', 'translation' => 'çayda üzmək'],
            ['word' => 'swim in the lake', 'translation' => 'göldə üzmək'],
        ];

        foreach ($words as $item) {
            $dictionary = Dictionary::updateOrCreate(
                ['word' => $item['word']],
                ['translation' => $item['translation']]
            );

            $dictionary->categories()->syncWithoutDetaching([
                $category->id,
            ]);
        }
    }
}
