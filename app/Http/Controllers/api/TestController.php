<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audio;
use App\Models\para;
use App\Models\question;
use App\Models\Transaction;
use App\Models\result;
use App\Models\celpip;
use App\Models\test;
use Auth;

class TestController extends Controller
{


    public function get_test_by_id($user_id, $test_id)
    {
        $lastTransaction = Transaction::where('user_id', $user_id)
            ->where('transaction_status', 'success')
            ->latest('subscription_expiry')
            ->first();

        if (!$lastTransaction || now()->gt($lastTransaction->subscription_expiry)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid user or subscription not active.',
            ]);
        }

        // If test_id is provided, fetch only that specific test
        if ($test_id) {
            $test = test::where('id', $test_id)
                ->select('id', 'question_ids', 'audio_ids', 'para_ids')
                ->first();

// return response()->json([$test]);

            // Check if the provided test_id is valid
            if (!$test) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid test ID.',
                ]);
            }
            $testData['paragraphs'] = []; // Initialize paragraphs array for this test
        $paraIds = explode(',', $test['para_ids']);

        foreach ($paraIds as $paraId) {
            $paragraphData = []; // Initialize paragraphData for each paragraph

            $paragraph = para::where('id', $paraId)
                ->select('id', 'paragraph', 'para_img', 'question_ids')
                ->first();



       
            if ($paragraph) {
                $questionIds = explode(',', $paragraph['question_ids']);

                $paragraphData = [
                    'id' => $paragraph['id'],
                    'paragraph' => $paragraph['paragraph'],
                    'para_img' => $paragraph['para_img'],
                    'question_ids' => $questionIds,
                    // Store question_ids as an array
                    'questions' => [],
                    // Initialize an array to store related questions
                ];

                // Fetch related questions based on question_ids
                $questions = question::whereIn('id', $questionIds)
                    ->select('id', 'question', 'options', 'time', 'answer')
                    ->get();

                foreach ($questions as $question) {
                    $paragraphData['questions'][] = [
                        'id' => $question['id'],
                        'question' => $question['question'],
                        'options' => json_decode($question['options']),
                        'time' => $question['time'],
                        'answer' => json_decode($question['answer']),
                    ];
                }

                $testData['paragraphs'][] = $paragraphData;

                // Fetch related audio based on audio_id (assuming para table has audio_id field)
                $audioId = $paragraph['audio_id']; // Adjust this based on your database structure

                $audioData = []; // Initialize audioData for each audio item

                $audio = Audio::where('id', $audioId)
                    ->select('id', 'question_ids', 'audio_link', 'time')
                    ->first();

                if ($audio) {
                    $audioData = [
                        'id' => $audio['id'],
                        'audio_link' => $audio['audio_link'],
                        'time' => $audio['time'],
                        'question_ids' => $audio['question_ids'],
                        'questions' => [],
                        // Initialize an array to store related questions
                    ];

                    // Fetch related questions based on question_ids
                    $questions = question::whereIn('id', explode(',', $audio['question_ids']))
                        ->select('id', 'question', 'options', 'time', 'answer')
                        ->get();

                    foreach ($questions as $question) {
                        $audioData['questions'][] = [
                            'id' => $question['id'],
                            'question' => $question['question'],
                            'options' => json_decode($question['options']),
                            'time' => $question['time'],
                            'answer' => json_decode($question['answer']),
                        ];
                    }

                    $testData['audios'][] = $audioData;
                }
            }
        }
        $data[] = $testData;
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Data retrieved successfully',
        'data' => $data,
    ]);
}



public function get_result()
{
    $data = result::get();
    return response()->json([
        'status' => 'success',
        'message' => 'Results retrieved successfully',
        'data' => $data,
    ]);
    
}















    public function get_test_by_testtype($user_id, $test_type)
    {
        $lastTransaction = Transaction::where('user_id', $user_id)
            ->where('transaction_status', 'success')
            ->latest('subscription_expiry')
            ->first();

        if (!$lastTransaction || now()->gt($lastTransaction->subscription_expiry)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid user or subscription not active.',
            ]);
        }

        // If test_id is provided, fetch only that specific test
        if ($test_type) {
            $test = test::where('test_type', $test_type)
                ->select('id', 'question_ids', 'audio_ids', 'para_ids')
                ->first();

            // Check if the provided test_id is valid
            if (!$test) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid test ID.',
                ]);
            }
            $questionIds = explode(',', $test['question_ids']);
            $audioIds = explode(',', $test['audio_ids']);
            $paraIds = explode(',', $test['para_ids']);

            $testData = [
                'test_type' => $test_type,
                'questions' => [],
                'audios' => [],
                'paragraphs' => [],
            ];


            $data = [];




            // Fetch speaking questions related to the test
            $questions = question::whereIn('id', $questionIds)
                ->select('id', 'question', 'prep_time', 'time', 'img1', 'img2', 'img3')
                ->get();

            foreach ($questions as $question) {
                $testData['questions'][] = [
                    'id' => $question['id'],
                    'question' => $question['question'],
                    'prep_time' => $question['prep_time'],
                    'img1' => $question['img1'],
                    'img2' => $question['img2'],
                    'img3' => $question['img3'],
                ];
            }

            // Fetch audios related to the test
            $testData['audios'] = []; // Initialize audios array for this test

            foreach ($audioIds as $audioId) {
                $audioData = []; // Initialize audioData for each audio item

                $audio = Audio::where('id', $audioId)
                    ->select('id', 'question_ids', 'audio_link', 'time')
                    ->first();

                if ($audio) {
                    $audioData = [
                        'id' => $audio['id'],
                        'audio_link' => $audio['audio_link'],
                        'time' => $audio['time'],
                        'question_ids' => $audio['question_ids'],
                        'questions' => [],
                        // Initialize an array to store related questions
                    ];

                    // Fetch related questions based on question_ids
                    $questions = question::whereIn('id', explode(',', $audio['question_ids']))
                        ->select('id', 'question', 'options', 'time', 'answer')
                        ->get();

                    foreach ($questions as $question) {
                        $audioData['questions'][] = [
                            'id' => $question['id'],
                            'question' => $question['question'],
                            'options' => json_decode($question['options']),
                            'time' => $question['time'],
                            'answer' => json_decode($question['answer']),
                        ];
                    }

                    $testData['audios'][] = $audioData;
                }
            }

            // Fetch paragraphs related to the test
            $testData['paragraphs'] = []; // Initialize paragraphs array for this test

            foreach ($paraIds as $paraId) {
                $paragraphData = []; // Initialize paragraphData for each paragraph

                $paragraph = para::where('id', $paraId)
                    ->select('id', 'paragraph', 'para_img', 'question_ids')
                    ->first();

                if ($paragraph) {
                    $questionIds = explode(',', $paragraph['question_ids']);

                    $paragraphData = [
                        'id' => $paragraph['id'],
                        'paragraph' => $paragraph['paragraph'],
                        'para_img' => $paragraph['para_img'],
                        'question_ids' => $questionIds,
                        // Store question_ids as an array
                        'questions' => [],
                        // Initialize an array to store related questions
                    ];

                    // Fetch related questions based on question_ids
                    $questions = question::whereIn('id', $questionIds)
                        ->select('id', 'question', 'options', 'time', 'answer')
                        ->get();

                    foreach ($questions as $question) {
                        $paragraphData['questions'][] = [
                            'id' => $question['id'],
                            'question' => $question['question'],
                            'options' => json_decode($question['options']),
                            'time' => $question['time'],
                            'answer' => json_decode($question['answer']),
                        ];
                    }

                    $testData['paragraphs'][] = $paragraphData;
                }
            }
            $data[] = $testData;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data retrieved successfully',
            'data' => $data,
        ]);
    }




    public function celpip_test()
    {
        $celpipData = celpip::select('id', 'test_ids', 'paid_type')->get()->toArray();
    

        // return response()->json($celpipData);
        $resultData = [];
    
        foreach ($celpipData as $celpip) {
            $testIds = explode(',', $celpip['test_ids']);
    
            $tests = test::whereIn('id', $testIds)
                ->select('id', 'question_ids', 'para_ids', 'audio_ids', 'paid_type', 'test_type')
                ->get()
                ->toArray();
    
            $testResults = array_map(function ($test) {
                // Fetch data for paragraphs based on para_ids
                $paraIds = explode(',', $test['para_ids']);
                $paras = para::whereIn('id', $paraIds)
                    ->select('id', 'question_ids', 'paragraph', 'time', 'para_img')
                    ->get()
                    ->toArray();
    
                foreach ($paras as &$para) {
                    $questionIds = explode(',', $para['question_ids']);
                    $questions = question::whereIn('id', $questionIds)
                        ->select('id', 'question', 'options', 'answer')
                        ->get()
                        ->toArray();
    
                    $questionResults = [];
    
                    foreach ($questions as $question) {
                        $questionResult = [
                            'id' => $question['id'],
                            'question' => $question['question'],
                            'options' => json_decode($question['options']),
                            'answer' => json_decode($question['answer']),
                        ];
    
                        $questionResults[] = $questionResult;
                    }
    
                    $para['questions'] = $questionResults;
                    unset($para['question_ids']);
                }
    
                // Fetch data for written and speaking test questions
                $writtenTestIds = explode(',', $test['question_ids']);
                $writtenQuestions = question::whereIn('id', $writtenTestIds)
                    ->select('id', 'question', 'time')
                    ->get()
                    ->toArray();
    
                $speakingTestIds = explode(',', $test['question_ids']);
                $speakingQuestions = question::whereIn('id', $speakingTestIds)
                    ->select('id', 'question', 'time', 'prep_time', 'img1', 'img2', 'img3')
                    ->get()
                    ->toArray();
    
                // Fetch data for audio files based on audio_ids
                $audioIds = explode(',', $test['audio_ids']);
                $audios = Audio::whereIn('id', $audioIds)
                    ->select('id', 'audio_link', 'video_link', 'time', 'question_ids')
                    ->get()
                    ->toArray();
    
                foreach ($audios as &$audio) {
                    $questionIds = explode(',', $audio['question_ids']);
                    $questions = question::whereIn('id', $questionIds)
                        ->select('id', 'que_audio','question', 'options', 'answer')
                        ->get()
                        ->toArray();
    
                    $questionResults = [];
    
                    foreach ($questions as $question) {
                        $questionResult = [
                            'id' => $question['id'],
                            'question' => $question['question'],
                            'que_audio' => $question['que_audio'], // Set the que_audio property

                            'options' => json_decode($question['options']),
                            'answer' => json_decode($question['answer']),
                        ];
    
                        $questionResults[] = $questionResult;
                    }
    
                    $audio['questions'] = $questionResults;
                    unset($audio['question_ids']);
                }
    
                $test['paras'] = $paras;
                $test['audios'] = $audios;
                $test['written_questions'] = $writtenQuestions;
                $test['speaking_questions'] = $speakingQuestions;
    
                return $test;
            }, $tests);
    
            $celpip['tests'] = $testResults;
            unset($celpip['test_ids']);
            $resultData[] = $celpip;
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Celpip test data fetched successfully',
            'data' => $resultData
        ]);
    }






    public function add_result(Request $request){
   

        $results = new result();
    
        // Assuming 'date_time' is a field in the 'result' table
        $results->date_time = $request->input('date_time');
        $results->celpip_test_id = $request->input('celpip_test_id');

        $results->speaking_ans_id = $request->input('speaking_ans_id');
        $results->writing_ans_id = $request->input('writing_ans_id');
        $results->user_id = $request->input('user_id');
        $results->test_id = $request->input('test_id');

        $results->l_bands = $request->input('l_bands');
        $results->r_bands = $request->input('r_bands');

        
        $results->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'result post successfully',
            'data' => $results,
        ]);

    }

   
    public function get_result_by_userId($user_id) {
        $results = result::where('user_id', $user_id)->get();
    
        if ($results->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found with the provided user_id',
            ], 404);
        }
    
        return response()->json([
            'status' => 'success',
            'message' => 'Results get by userId successfully',
            'data' => $results,
        ], 200);
    }
    



    
}


