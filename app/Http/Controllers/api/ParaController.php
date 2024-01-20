<?php

namespace App\Http\Controllers\Api; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\para; 
use App\Models\question;
use App\Models\test; 
use App\Models\User;
use App\Models\written;
use App\Models\Audio;
use Auth;
use Queue; 
class ParaController extends Controller
{
    
    public function get_para()
    {
        $user_id = Auth::id(); 
    
        $tests = test::where('test_type', '1')
            ->select('id', 'para_ids','paid_type')
            ->get()
            ->toArray();
    
        $resultData = array_map(function ($test) use ($user_id) {
            $questionIds = explode(',', $test['para_ids']);
    
            $paragraphs = para::select('id', 'paragraph', 'time', 'para_img', 'question_ids')
                ->whereIn('id', $questionIds)
                ->get()
                ->toArray();
    
            $paragraphResults = array_map(function ($paragraph) use ($user_id) {
                // Check if para_img is null
                
    
                $questionIds = explode(',', $paragraph['question_ids']);
    
                if (!empty($questionIds)) {
                    $questions = question::whereIn('id', $questionIds)
                        ->select('id', 'question', 'options',  'answer')
                        ->get();
    
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
    
                    $paragraph['questions'] = $questionResults;
                } else {
                    $paragraph['questions'] = [];
                }
    
                unset($paragraph['question_ids']);
                return $paragraph;
            }, $paragraphs);
    
            $test['paragraphs'] = $paragraphResults;
            unset($test['para_ids']);
            return $test;
        }, $tests);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Reading answers added successfully',
            'data' => $resultData
        ]);
    }
    
    
    


    public function get_write_test(Request $request) {
        $user_id = Auth::id(); 

        $data = test::select('id', 'question_ids', 'paid_type')
        ->where('test_type', '2')
        ->get()
        ->toArray();
        
        $data = array_map(function ($paragraph) use ($user_id) {
            $questionIds = explode(',', $paragraph['question_ids']); 
    
            if (!empty($questionIds)) {
                $questions = question::whereIn('id', $questionIds)
                    ->select('id', 'question',  'time',)
                    ->get();
    
                $results = [];
    
                foreach ($questions as $question) {
                    $result = [
                        'id' => $question['id'],
                        'question' => $question['question'],
                        'time' => $question['time'],

                    ];
    
                    $results[] = $result;
                }
    
                $paragraph['questions'] = $results;
            } else {
                $paragraph['questions'] = [];
            }
    
            unset($paragraph['question_ids']); 
            return $paragraph;
        }, $data);
    
    return response()->json([
        'status' => 'success',
        'message' => 'writing question get  successfully',
        'data' => $data
    ]);
    }








    public function post_test(Request $request)
    {

    
    //     $latestTest = test::latest()->first();

    // if (!$latestTest) {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'No tests available to associate with the writing answer.',
    //     ]);
    // }

    $writingAnswer = written::create([
        't1_ans' => $request->input('t1_ans'),
        't2_ans' => $request->input('t2_ans'),
        'test_id' => $request->input('test_id'),
        'user_id' => $request->input('user_id'),
        'celpip_test_id' => $request->input('celpip_test_id'),

    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Writing question submitted successfully',
        'data' =>$writingAnswer,
    ]);
}



public function listening()
{
    $user_id = Auth::id();

    $audioData = test::select('id', 'audio_ids', 'paid_type')
        ->where('test_type', '0')
        ->get()
        ->toArray();

    $audioData = array_map(function ($audio) use ($user_id) {
        $questionIds = explode(',', $audio['audio_ids']);

        if (!empty($questionIds)) {
            $questions = Audio::whereIn('id', $questionIds)
                ->select('id', 'audio_link', 'video_link', 'time', 'question_ids')
                ->get();

            $results = [];

            foreach ($questions as $question) {
                $questionIds = explode(',', $question['question_ids']);

                $questionDetails = question::whereIn('id', $questionIds)
                    ->select('id', 'que_audio', 'question', 'options', 'time', 'answer')
                    ->get();

                $questionResults = [];

                foreach ($questionDetails as $detail) {
                    $result = [
                        'id' => $detail['id'],
                        'question' => $detail['question'],
                        'que_audio' => $detail['que_audio'],
                        'options' => json_decode($detail['options']),
                        'time' => $detail['time'],
                        'answer' => json_decode($detail['answer']),
                    ];

                    $questionResults[] = $result;
                }

                $audioResult = [
                    'id' => $question['id'],
                    'audio_link' => $question['audio_link'],
                    'video_link' => $question['video_link'],
                    'time' => $question['time'],
                    'questions' => $questionResults,
                ];

                $results[] = $audioResult;
            }

            $audio['audio_data'] = $results;
        } else {
            $audio['audio_data'] = [];
        }

        unset($audio['audio_ids']);
        return $audio;
    }, $audioData);

    return response()->json([
        'status' => 'success',
        'message' => 'Listening answers retrieved successfully',
        'data' => $audioData,
    ]);
}





}
