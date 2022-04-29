<?php

namespace Database\Seeders\Master;

use App\Models\Master\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use League\Csv\Reader;
use League\Csv\Statement;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csv = Reader::createFromPath(__DIR__.'/../data/study_program.csv');
        $csv->setHeaderOffset(0);
        $csv->setDelimiter(";");

        $data = new Collection();
        foreach ((new Statement())->process($csv) as $value) {

            $code = StudyProgram::generateCodeFromName($value['name']);
            if ($data->where('code',$code)->first()){
                while (true){
                    $randInt = random_int(1,999);
                    if (!$data->where('code',$code.$randInt)->first()){
                        $code = $code.$randInt;
                        break;
                    }
                }
            }
            $value['code'] = $code;

            $data->add($value);
        }
        dd($data->unique('code')->count(),$data->count());
    }
}
