<?php

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en'=> 'First grade', 'ar'=> 'الصف الاول'],
            ['en'=> 'First grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'First grade', 'ar'=> 'الصف الثالث'],
            ['en'=> 'First grade', 'ar'=> 'الصف الرابع'],
            ['en'=> 'First grade', 'ar'=> 'الصف الخامس'],
            ['en'=> 'First grade', 'ar'=> 'الصف السادس'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الاول'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثالث'],
            ['en'=> 'Third grade', 'ar'=> 'الصف الاول'],
            ['en'=> 'Third grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third grade', 'ar'=> 'الصف الثالث'],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
            'Name_Class' => $classroom,
            'Grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
