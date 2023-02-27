<?php


namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades = Grade::all();
    return view('pages.Grades.Grades',compact('Grades'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrades $request)
  {
    // test if the Name is unique  or from StoreGrades
    if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en',$request->Name_en)->exists()) {

        return redirect()->back()->withErrors(trans('Grades_trans.exists'));
    }


    try {
          $validated = $request->validated();   // app -> http -> request

          $Grade = new Grade();

          /*
          $translations = [
              'en' => $request->Name_en,
              'ar' => $request->Name
          ];
          $Grade->setTranslations('Name', $translations);
          */

          $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
          $Grade->Notes = $request->Notes;
          $Grade->save();
          toastr()->success(trans('messages.success'));
          return redirect()->route('Grades.index');
      }

      catch (\Exception $e){  // Exception from laravel
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }


  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
   public function update(StoreGrades $request)   // add request
 {
   try {

       $validated = $request->validated();
       $Grades = Grade::findOrFail($request->id);
       $Grades->update([
         $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
         $Grades->Notes = $request->Notes,
       ]);
       toastr()->success(trans('messages.Update'));
       return redirect()->route('Grades.index');
   }
   catch
   (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
 }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)  // Grade and classrooms oncascade delete
  {
      $MyClass_id = Classroom::where('Grade_id',$request->id)->pluck('Grade_id');  // لو المرحلة الدراسية فيها صفوف

      if($MyClass_id->count() == 0){

          $Grades = Grade::findOrFail($request->id)->delete();  // لو مافي صفوف بيحذف فورا المرحلة
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('Grades.index');
      }

      else{

          toastr()->error(trans('Grades_trans.delete_Grade_Error'));  // لو في صفوف بيرجع برسالة غلط
          return redirect()->route('Grades.index');

      }


  }

}
