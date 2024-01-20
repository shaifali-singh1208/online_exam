<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Validator, Redirect, Response;

use Illuminate\Http\Request;
use App\Models\para;
use App\Models\question;
use App\Models\test;
use App\Models\User;
use App\Models\written;
use App\Models\speak;

class WriteController extends Controller
{
    public function get_speak()
    {
        $tests = test::where('test_type', '3')->
            select('id', 'paid_type', 'test_type', 'question_ids')

            ->get()
            ->toArray();

        $data = [];

        foreach ($tests as $test) {
            $questionIds = explode(',', $test['question_ids']);
            $paragraph = [
                'id' => $test['id'],
                'test_type' => $test['test_type'],
                'paid_type' => $test['paid_type']
            ]; 

            if (!empty($questionIds)) {
                $questions = question::whereIn('id', $questionIds)
                    ->select('id', 'question', 'prep_time', 'time', 'img1', 'img2', 'img3')
                    ->get();

                $results = [];

                foreach ($questions as $question) {
                    $result = [
                        'id' => $question['id'],
                        'question' => $question['question'],
                        'prep_time' => $question['prep_time'],
                        'time' => $question['time'],
                        'img1' => $question['img1'],
                        'img2' => $question['img2'],
                        'img3' => $question['img3'],
                    ];

                    $results[] = $result;
                }

                $paragraph['questions'] = $results;
            } else {
                $paragraph['questions'] = [];
            }

            $data[] = $paragraph;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Speaking  questions retrieved successfully',
            'data' => $data,
        ]);
    }



    // $responseData[] = [
    //     'status' => 'success',
    //     'message' => 'Reading answers added successfully',
    //     'id' => $test['id'],

    //     'test_type' => $test['test_type'],
    //     'questions' => $questions->toArray(),
    // ];



    // return response()->json($responseData);



//     public function add_speaking_answer(Request $request)
// {
//     $writingAnswer = speak::create([
//         'test_id' => $request->input('test_id'),
//         'user_id' => $request->input('user_id'),
//     ]);

//     $audioFile = $request->file('a1');

//     if ($request->hasFile('a1') && $audioFile->isValid()) {
//         $audioName = time() . '_a1.' . $audioFile->getClientOriginalExtension();
//         $audioFile->move(public_path('assets/audio'), $audioName);
//         // Assign the 'a1' field directly to the model
//         $writingAnswer->a1 = url('assets/audio/' . $audioName);
//         $writingAnswer->save(); 
//     } else {
//         $writingAnswer->a1 = null;
//         $writingAnswer->save(); 

//     return response()->json([
//         'status' => 'success',
//         'message' => 'Speaking Answer submitted successfully',
//         'data' => $writingAnswer,
//     ]);
// }

        // $audioFile2 = $request->file('a2'); // Assuming 'audio' is the name attribute in your form input







        public function add_speaking_answer(Request $request)
        {
            $validator = Validator::make($request->all(), [
              
                'a1' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a2' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a3' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a4' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a5' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a6' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a7' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
                'a8' => 'max:20480|mimes:audio/mpeg,mpga,mp3,wav,aac',
            ]);
        
            $writingAnswer = speak::create([
                'celpip_test_id' => $request->input('celpip_test_id'),
// return response()->json('')
                'test_id' => $request->input('test_id'),
                'user_id' => $request->input('user_id'),
                'a1' => null,
                'a2' => null,
                'a3' => null,
                'a4' => null,
                'a5' => null,
                'a6' => null,
                'a7' => null,
                'a8' => null,
            ]);
        
            $audioFields = ['a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8'];
        
            foreach ($audioFields as $field) {
                $audioFile = $request->file($field);
        
                if ($request->hasFile($field) && $audioFile->isValid()) {
                    $audioName = time() . '_' . $field . '.' . $audioFile->getClientOriginalExtension();
                    $audioFile->move(public_path('assets/audio'), $audioName);
                    // Assign the audio field directly to the model
                    $writingAnswer->$field = url('assets/audio/' . $audioName);
                }
            }
        
            // Save the model only once after processing all audio fields
            $writingAnswer->save();
        
            return response()->json([
                'status' => 'success',
                'message' => 'Speaking Answer submitted successfully',
                'data' => $writingAnswer,
            ]);
        }
        
}