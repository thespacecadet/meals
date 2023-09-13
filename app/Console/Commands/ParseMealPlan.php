<?php

namespace App\Console\Commands;

use App\Models\Additive;
use App\Models\Meal;
use Illuminate\Console\Command;
use PHPHtmlParser\Dom;

class ParseMealPlan extends Command
{
    /**
     * hard coded menu list order
     *
     * @var string
     */
    public $menulist = ['Datum', 'Menü 1', 'Extratheke', 'Vegetrisches Menü', 'AktionsTheke', 'Pizza'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:meal-plan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse meal plan into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dom = new Dom();
        $dom->loadFromUrl('https://www.studierendenwerk-koblenz.de/plugins/content/speiseplan/table_uniko_print.html');
//        $html = $dom->outerHtml;

        $table1 = $dom->find('table')[0];
        $tbody1 = $table1->find('tbody');
        $table2 = $dom->find('table')[1];
        foreach ($tbody1->find('tr') as $line) {
            $date = $line->find('th')->find('.date')->innerHtml;
            foreach ($line->find('td') as $cell) {
                $mealName = $this->getCleanMealText($cell->innerHtml);

                //check if meal is vegan (strpos is case-sensitive. will only tell its vegan if its written with a capital V)
                //this is not working as intended
                if($this->isVegan($mealName)){
                    $vegan = true;
                }
                else{
                    $vegan = false;
                }

                $additives = [];
                foreach ($cell->find('a') as $additive) {
                    $newAdditive = new Additive();
                    $newAdditive->name = $additive->title;
                    $id = $additive->innerHtml;
//                    if($dbAdditive = Additive::findOrFail($id)){
//
//                    };
//                    $newAdditive->nr = $additive->innerHtml;
//                    $newAdditive->id = $additive->innerHtml;
//
//                    $newAdditive->save();


                    $additives[] = $additive->innerHtml;
                }

                $meal = new Meal();
                $meal->vegan = $vegan;
                $meal->name = $mealName;
                $meal->description = $mealName;

                $meal->save();
//                echo '<pre>'; print_r($additives); echo '</pre>';
            }
        }
    }


    public function getCleanMealText($mealtext)
    {
        return substr($mealtext, 0, strpos($mealtext, '<'));
    }

    public function isVegan($mealtext)
    {
        return substr($mealtext, 0, strpos($mealtext, 'Vegan'));
    }
}
