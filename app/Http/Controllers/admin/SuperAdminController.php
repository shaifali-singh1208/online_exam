<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\written;
use Illuminate\Http\Request;
use App\Models\question;
use App\Models\test;
use App\Models\speak;
use App\Models\result;
use App\Models\celpip;


class SuperAdminController extends Controller
{
    public function expert()
    {
        if (!session()->has('experts')) {
            return redirect('/');



        }
        // elseif (!session()->has('userDetails')){
        //     return redirect('/');
        // }else{



            $questions = celpip::select('id', 'test_ids', 'paid_type')
            ->orderBy('id', 'desc')
            ->get();
        
        // $data = test::select('id','test_type', 'question_ids')
        //     ->where('test_type', '3')
        //     ->get();

        if ($questions) {
            return view('experts.writing_answer', ['questions' => $questions,]);
        } else {
        }

    }













    public function written_ques($id)
    {

        $celpip = celpip::findOrFail($id);
        $questionIds = explode(',', $celpip->test_ids);

        $test_ques = test::whereIn('id', $questionIds)->where('test_type', '2')

            ->get();

        // $questionIds = explode(',', $test->question_ids);

        // $questions = question::whereIn('id', $questionIds)->get();

        return view('experts.written_ques', ['test_ques' => $test_ques, 'celpip' => $celpip]);
    }






    public function written_question($celpip, $test_id, )
    {

        $celpip = celpip::findOrFail($celpip);

        $test = test::findOrFail($test_id);


        $questionIds = explode(',', $test->question_ids);

        $questions = question::whereIn('id', $questionIds)->get();

        return view('experts.writing_question', ['questions' => $questions, 'test' => $test, 'celpip' => $celpip]);
    }


    public function written_answer($id, $test_id, $question_id)
    {
        $celpip = celpip::findOrFail($id);

        $test = test::findOrFail($test_id);

        $questionIds = explode(',', $test->question_ids);

        $position = array_search($question_id, $questionIds);

        $answer = null;
        $written_id = null;

        if ($position !== false) {
            $answerColumn = ($position === 0) ? 't1_ans' : 't2_ans';

            $writtenAnswer = written::where('test_id', $test_id)->first();

            if ($writtenAnswer) {
                $written_id = $writtenAnswer->id;
                $answerValue = $writtenAnswer->$answerColumn;

                // Check if $answerValue is not null
                if ($answerValue !== null) {
                    $answer = is_object($answerValue) ? $answerValue->id : $answerValue;
                } else {
                    $answer = 'No answer found';
                }
            } else {
                $answer = 'No answer found';
            }
        }

        return view('experts.written_ans', compact('answer', 'question_id', 'test_id', 'written_id', 'celpip'));
    }



    public function update_result($id, $test_id, $write_id)
    {
        $celpip = celpip::findOrFail($id); // Assuming 'Celpip' is the correct model name
    
        $test_ids = explode(',', $celpip->test_ids);
    
        // Use 'whereIn' to filter tests based on the test_ids array
        $tests = test::whereIn('id', $test_ids)->get();
    
        // Use 'first' to get the first matching written record
        $written = written::whereIn('test_id', $tests->pluck('id'))->first();
    
        $written_id = $written ? $written->id : null;
    
        return view('experts.result_answer', compact('tests', 'written_id', 'celpip'));
    }
    
    
    

    
    public function update_written_ans(Request $request)
    {
        // Uncomment this line to check the request data
        // dd($request->all());
    
        $celpip_test_id = $request->input('celpip_test_id');
        $test_id = $request->input('test_id');
        $written_ans_id = $request->input('writing_ans_id');
        $w_bands = $request->input('w_bands');
    
        $written = written::where('id', $written_ans_id)
            ->where('celpip_test_id', $celpip_test_id)
            ->first();
    
        if ($written) {
            $result = result::where('celpip_test_id', $celpip_test_id)
                ->where('writing_ans_id', $written_ans_id) 
                ->first();
    
            if ($result) {
                // Get the current value of 'w_bands' from the database
                $lastValue = $result->w_bands;

               // Update 'w_bands' field in the database with the new value and the average of current and last value
                $result->update(['w_bands' => ($lastValue + $w_bands) / 2]);
    
                if ($result->l_bands !== null && $result->r_bands !== null && $result->s_bands !== null && $result->w_bands !== null) {
                    $count = $result->l_bands + $result->r_bands + $result->s_bands + $result->w_bands;
                    $totalavg = $count / 4;
    
                    // Update overall_bands
                    result::where('celpip_test_id', $celpip_test_id)
                        ->where('writing_ans_id', $written_ans_id)
                        ->update(['overall_bands' => $totalavg]);
    
                    // Retrieve the updated record if needed
                    $updatedResult = result::where('celpip_test_id', $celpip_test_id)
                        ->where('writing_ans_id', $written_ans_id)
                        ->first();
    
                    // dd($updatedResult);
                }
    
                return redirect()->back()->with('success', 'Result updated successfully.');
            } else {
                return redirect()->back()->with('error', 'No result found for the given test and writing answer.');
            }
        } else {
            return redirect()->back()->with('error', 'No written answer found for the given test and question.');
        }
    }
    
    


        
    
    








    public function speaking_test()
    {
        if (!session()->has('experts')) {
            return redirect('/');
        }

        $questions = celpip::select('id', 'test_ids', 'paid_type')
        ->orderBy('id', 'desc')
        ->get();
    
        // $data = test::select('id','test_type', 'question_ids')
        //     ->where('test_type', '3')
        //     ->get();

        if ($questions) {
            return view('experts.speaking_answer', ['questions' => $questions,]);
        } else {
            // Log the error or dd() to see the error details
        }
    }




    public function speaking_ques($id)
    {
        $celpip = celpip::findOrFail($id);
        $questionIds = explode(',', $celpip->test_ids);
    
        $test_ques = test::whereIn('id', $questionIds)->where('test_type', '3')->get();
    
        return view('experts.speaking_question', ['test_ques' => $test_ques, 'celpip' => $celpip]);
    }
    
public function speaking_answer($celpip, $test_id, )
    {

        $celpip = celpip::findOrFail($celpip);

        $test = test::findOrFail($test_id);


        $questionIds = explode(',', $test->question_ids);

        $questions = question::whereIn('id', $questionIds)->get();

        return view('experts.speaking_ques', ['questions' => $questions, 'test' => $test, 'celpip' => $celpip]);
    }











    





    public function speaking_ans($id,$test_id, $question_id)
    {
        $celpip = celpip::findOrFail($id);

        $speak_answer = [];
        $test = test::findOrFail($test_id);

        $questionIds = explode(',', $test->question_ids);

        $position = array_search($question_id, $questionIds);

        $answer = null;

        if ($position !== false) {
            $answerColumn = 'a' . ($position + 1);

            $spokenAnswer = speak::where('test_id', $test_id)->first();

            if ($spokenAnswer) {
                $speaking_id = $spokenAnswer->id;

                $answerValue = $spokenAnswer->$answerColumn;

                // Check if $answerValue is not null
                if ($answerValue !== null) {
                    $answer = is_object($answerValue) ? $answerValue->id : $answerValue;
                } else {
                    $answer = 'No answer found';
                }
            } else {
                $answer = 'No answer found';
            }
        }

        return view('experts.speaking_ans', compact('answer', 'question_id', 'test_id', 'speaking_id','celpip'));
    }










    public function update_speaking_result($id, $test_id, $write_id)
    {
        $celpip = Celpip::findOrFail($id); 
        $test_ids = explode(',', $celpip->test_ids);
    
        $tests = test::whereIn('id', $test_ids)->get();
    
        $written = speak::whereIn('test_id', $tests->pluck('id'))->first();
    
        $speak_id = $written ? $written->id : null;
    
        return view('experts.result_speaking_update', compact('tests', 'celpip','speak_id'));
    }




    public function update_speaking_ans(Request $request)
    {
        //  dd($request->all());
        $celpip_test_id = $request->input('celpip_test_id');
        $test_id = $request->input('test_id');
        $speaking_ans_id = $request->input('speaking_ans_id');
        $s_bands = $request->input('s_bands');

        $written = speak::where('id', $speaking_ans_id)
        ->where('celpip_test_id', $celpip_test_id)
        ->first();
    
        if ($written) {
            $result = result::where('celpip_test_id', $celpip_test_id)
                ->where('speaking_ans_id', $speaking_ans_id) 
                ->first();
    
    
            if ($result) {
                $lastValue = $result->s_bands;

               // Update 'w_bands' field in the database with the new value and the average of current and last value
                $result->update(['s_bands' => ($lastValue + $s_bands) / 8]);

                // $result->update(['s_bands' => $s_bands]);
    // dd($result);
                // Check if l_bands, r_bands, s_bands, and w_bands are not null
                if ($result->l_bands !== null && $result->r_bands !== null && $result->s_bands !== null && $result->w_bands !== null) {
                    $count = $result->l_bands + $result->r_bands + $result->s_bands + $result->w_bands;
                    $totalavg = $count / 4;
    
                    // Update overall_bands
                    result::where('celpip_test_id', $celpip_test_id)
                        ->where('speaking_ans_id', $speaking_ans_id)
                        ->update(['overall_bands' => $totalavg]);
    
                    // Retrieve the updated record if needed
                    $updatedResult = result::where('celpip_test_id', $celpip_test_id)
                        ->where('speaking_ans_id', $speaking_ans_id)
                        ->first();
    
                    // dd($updatedResult);
                }
            
    
                return redirect()->back()->with('success', 'Result updated successfully.');        } else {
            return redirect()->back()->with('error', 'No result found for the given test and writing answer.');
        }
    } else {
        return redirect()->back()->with('error', 'No written answer found for the given test and question.');
    }
    


    }
}
