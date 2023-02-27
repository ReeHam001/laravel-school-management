<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{

    use HasTranslations;

    public $translatable = ['Name_Class'];  // الو ترجمة

    protected $table = 'Classrooms';

    public $timestamps = true;

    protected $fillable=['Name_Class','Grade_id'];


    // علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف

    public function Grades()  // one to many
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

}
