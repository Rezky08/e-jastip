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
            $value['code'] = $code;
            $studyProgram = new StudyProgram($value);
            $studyProgram->save();
            $data->add($studyProgram);
        }
    }
}
