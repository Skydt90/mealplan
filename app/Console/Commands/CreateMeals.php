<?php

namespace App\Console\Commands;

use App\Models\Meal;
use Illuminate\Console\Command;

class CreateMeals extends Command
{
    private $meals = [
        'Pasta med Kødsovs' => 1, 'Pastasalat' => 2, 'Kylling i Karry' => 2, 'Hønsekødssuppe' => 1,
        'Blomkålssuppe' => 2, 'Boller i Karry' => 4, 'Hjemmelavet Burger' => 3, 'Mexicanske Pandekager' => 3,
        'Kyllingesalat' => 2, 'Lasagne' => 2, 'Kylling m. Ovnkartofler' => 3, 'Chili Con Carne' => 2, 'Pasta m. Laks' => 1,
        'Tortellini m. Tomatsauce' => 3, 'Kylling m. Rodfrugter' => 3, 'Hjemmelavet Pizza' => 4, 'Risret' => 1, 'Tarteletter' => 2,
        'Fiskepinde m. Rugbrød' => 1, 'Spejlæg m. Rugbrød' => 1, 'Spaghetti m. Kødsovs' => 1, 'Knuste Kartofler m. Ost og Kød' => 3,
        'Kylleryller m. Salat' => 2, 'Wokret m. Nudler' => 2, 'Fiskefrikadeller m. Ris' => 3, 'Kartofler m. Salat og Kød' => 4,
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meals:create-meals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed meals. Workaround php version';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(count($this->meals));
        $bar->setFormat('very_verbose');

        foreach($this->meals as $name => $effort) {
            Meal::create(['name' => $name, 'effort' => $effort]);
            $bar->advance(1);
        }
        $bar->finish();
        $this->output->writeln(PHP_EOL);
    }
}
