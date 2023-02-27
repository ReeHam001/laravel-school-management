<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0, $questioncount = 0;

    public function render()
    {
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();  // هنا الداتا رجع مصفوفة الاسئلة كلها تبع الاختبار
        $this->questioncount = $this->data->count();
        return view('livewire.show-question', ['data']);  // مصفوفة اوبجكت
    }

    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quizze_id', $this->quizze_id)
            ->first();

        // insert (لو مافي اجابات)
        if ($stuDegree == null) {
            $degree = new Degree();
            $degree->quizze_id = $this->quizze_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;

            if (strcmp(trim($answer), trim($right_answer)) === 0) { // trim مقارنة عدد المحارف
                $degree->score += $score;  //  The strcmp () function compares two strings
            } else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();

        } else {

            // update (في حال لقى اجابات)
            if ($stuDegree->question_id >= $this->data[$this->counter]->id) {
                $stuDegree->score = 0;
                $stuDegree->abuse = '1';
                $stuDegree->save();

                toastr()->error('تم إلغاء الاختبار لإكتشاف تلاعب بالنظام');
                return redirect('student_exams');
            } else {

                $stuDegree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $stuDegree->score += $score;
                } else {
                    $stuDegree->score += 0;
                }
                $stuDegree->save();
            }
        }

        if ($this->counter < $this->questioncount - 1) {  // questioncount عدد اسئلة الاختبار
            $this->counter++;  // مشان ينتقل عالسؤال يلي بعده
        } else {
            toastr()->success('تم إجراء الاختبار بنجاح');
            return redirect('student_exams');
        }

    }
}
