<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\question;
use App\Models\para;
use App\Models\test;
use App\Models\celpip;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ParagraphController extends Controller
{
    public function paragraph()
    {
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {

            // dd($assets);
            return view("admin.paragraph.paragraph");
        }

    }

    public function add_para(Request $request)
    {
        $request->validate([
            'paid_type'=> 'required',
        ]);
        
        $paragraphsData = $request->input('paragraphs');
        $time = $request->input('time');
        $paid_type = $request->input('paid_type');
        $test_id = []; // Initialize as an empty array
    
        $paragraphIds = [];
    
        foreach ($paragraphsData as $index => $paragraphData) {
            $questionIds = [];
            $imageFileName = null; // Default image value
    
            if ($request->hasFile('paragraphs.' . $index . '.para_img')) {
                $image = $request->file('paragraphs.' . $index . '.para_img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/uploads'), $imageName);
                $publicUrl = url('assets/uploads/' . $imageName); // Use the url() function
    
                $imageFileName = $publicUrl;
            }
            $questionData = $paragraphData['questions'];
            $paragraphTime = isset($paragraphData['time']) ? $paragraphData['time'] : null;

            foreach ($questionData as $question) {
                $newQuestion = new question();
                $newQuestion->question = $question['text'];
                
                // Check if the index exists in the $time array before accessing it
                $newQuestion->time = $paragraphTime;
                $newQuestion->options = json_encode(array_values($question['options']));
                $newQuestion->answer = $question['answer'];
                $newQuestion->save();
                $questionIds[] = $newQuestion->id;
            }
    
            $paragraph = new para();
            $paragraph->paragraph = $paragraphData['text'];
            $paragraph->para_img = $imageFileName;
         $paragraph->time = $paragraphTime;
            
            $paragraph->question_ids = implode(',', $questionIds);
            $paragraph->save();
            $paragraphIds[] = $paragraph->id;
        }
    
        // Your code here
        $test_type = '1';
        $test = new test();
        $test->para_ids = implode(',', $paragraphIds);
        $test->test_type = $test_type;
        $test->paid_type = $paid_type;
        $test->save();
    
        return redirect('paragraph')->with('success', 'Paragraphs and questions added successfully');
    }
    


    public function test_write()
    {
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {

            // dd($assets);
            return view("admin.writting.write_test");
        }

    }


    public function test_written(Request $request)
    {
        $request->validate([
            "paid_type"=> "required",
        ]);

        $questions = $request->input('question');
        $times = $request->input('time');
        $paid_type = $request->input('paid_type');

        $questionIds = [];

        for ($i = 0; $i < count($questions); $i++) {
            $newQuestion = new question();
            $newQuestion->question = $questions[$i];
            $newQuestion->time = $times[$i];
            $newQuestion->save();
            $questionIds[] = $newQuestion->id;
        }
        $test_id = [];
        $test_type = '2';

        $test = new test();
        $test->question_ids = implode(',', $questionIds);
        $test->test_type = $test_type;
        $test->paid_type = $paid_type;
        $test->save();
        $test_id = $test->id;


        $celpiph = new celpip();
        $celpiph->test_ids = json_encode([$test_id]);
        $celpiph->paid_type = $paid_type; // Save test ID as an array
        // Save test ID as an array
        $celpiph->save();

        return redirect('test_write')->with('success', 'Written test questions added successfully');

    }

}

