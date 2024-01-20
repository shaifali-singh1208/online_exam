<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\question;
use App\Models\para;
use App\Models\test;
use App\Models\celpip;
use App\Models\Audio;

use Validator, Redirect, Response;
use Str;
use session;

class SpeakController extends Controller
{
    public function speak()
    {
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {
            return view("admin.speaking.speaking");
        }
    }

    public function create()
    {

        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {
            return view('admin.speaking.speak_test');
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'paid_type' => 'required',
        ]);

        $paid_type = $request->input('paid_type');
        $questions = $request->input('question');
        $prep_times = $request->input('prep_time');
        $time = $request->input('time');
        $test_type = '2';
        $questionIds = [];

        for ($i = 0; $i < count($questions); $i++) {
            $newQuestion = new question();
            $newQuestion->time = $time[$i];
            $newQuestion->question = $questions[$i];

           
            $publicUrl = null;
            $publicUrl1 = null;
            $publicUrl2 = null;

            if (isset($request->file('img1')[$i]) && $request->file('img1')[$i]->isValid()) {
                $imageurl = time() . $request->file('img1')[$i]->getClientOriginalName();
                $request->file('img1')[$i]->move(public_path() . '/assets/uploads/', $imageurl);
                $publicUrl = url('assets/uploads/' . $imageurl); // Use the url() function
            }
            
            if (isset($request->file('img2')[$i]) && $request->file('img2')[$i]->isValid()) {
                $imageurl1 = time() . $request->file('img2')[$i]->getClientOriginalName();
                $request->file('img2')[$i]->move(public_path() . '/assets/uploads/', $imageurl1);
                $publicUrl1 = url('assets/uploads/' . $imageurl1); // Use $imageurl1 for img2
            
            }
            
            if (isset($request->file('img3')[$i]) && $request->file('img3')[$i]->isValid()) {
                $imageurl2 = time() . $request->file('img3')[$i]->getClientOriginalName();
                $request->file('img3')[$i]->move(public_path() . '/assets/uploads/', $imageurl2);
                $publicUrl2 = url('assets/uploads/' . $imageurl2); // Use $imageurl2 for img3
            
            }
            

            $newQuestion->img1 = $publicUrl ?? null; // Use $publicUrl or null if it's not set
            $newQuestion->img2 = $publicUrl1 ?? null;
            $newQuestion->img3 = $publicUrl2 ?? null;

            $newQuestion->prep_time = isset($prep_times[$i]) ? $prep_times[$i] : null;

            $newQuestion->save();
            $questionIds[] = $newQuestion->id;
        }

        $test_type = "3";
        $test = new test();
        $test->question_ids = implode(',', $questionIds);
        $test->test_type = $test_type;
        $test->paid_type = $paid_type;
        $test->save();

        return redirect('speak')->with('success', 'Speaking Test added successfully');
    }



    public function listen()
    {
        return view('admin.listening.listening');
    }

    public function listens(Request $request)
    {


        $request->validate([
            'audio.*.audio_quest' => 'file|max:20480',
            'audio.*.video_link' => 'file|max:71680', // 70 megabytes in kilobytes
            'audio.*.questions.*.que_audio' => 'file|max:20480',
            'paid_type' => 'required',
        ]);


        $paid_type = $request->input('paid_type');

        if ($request->has('audio')) {
            $audiosData = $request->input('audio');
            $audio_ids = [];
            $test_id = [];

            foreach ($audiosData as $index => $audioData) {
                $audio = new Audio();
                $publicUrl = null;
                $VideoUrl = null;


                if ($request->hasFile('audio.' . $index . '.audio_quest')) {
                    $audioFile = $request->file('audio.' . $index . '.audio_quest');
                    $audioName = time() . '_audio.' . $audioFile->getClientOriginalExtension();
                    $audioFile->move(public_path('assets/audio'), $audioName);
                    $audio->audio_link = url('assets/audio/' . $audioName);
                } else {
                    $audio->audio_link = null;
                }

                if ($request->hasFile('audio.' . $index . '.video_link')) {
                    $videoFile = $request->file('audio.' . $index . '.video_link');
                    $videoName = time() . '_video.' . $videoFile->getClientOriginalExtension();
                    $videoFile->move(public_path('assets/audio'), $videoName);
                    $audio->video_link = url('assets/audio/' . $videoName);
                } else {
                    $audio->video_link = null;
                }

                // $audio->audio_link = $publicUrl??null;
                // $audio->video_link = $VideoUrl ?? null;
                $audio->time = $audioData['time'];

                // Save the audio record
                //  $audio->save();
                $questionIds = [];
                if (isset($audioData['questions']) && is_array($audioData['questions'])) {
                    foreach ($audioData['questions'] as $key => $questionData) {
                        $question = new question();
                        $question->question = $questionData['text'];

                        if ($request->hasFile('audio.' . $index . '.questions.' . $key . '.que_audio')) {
                            $audioQues = $request->file('audio.' . $index . '.questions.' . $key . '.que_audio');
                            $audioName = time() . '_audio.' . $audioQues->getClientOriginalExtension();
                            $audioQues->move(public_path('assets/audio'), $audioName);
                            $public2Url = url('assets/audio/' . $audioName);
                        } else {
                            $public2Url = null;
                        }
                
                        $question->que_audio = $public2Url;

                        $options = [];
                        for ($i = 1; $i <= 4; $i++) {
                            $options[] = $questionData['options'][$i];
                        }
                        $question->options = json_encode($options);
                        $question->answer = $questionData['answer'];
                        $question->time = $audioData['time'];

                        // Save the question
                        $question->save();



                        $questionIds[] = $question->id;
                    }
                }

                $audio->question_ids = implode(',', $questionIds);
                $audio->save();
                $audio_ids[] = $audio->id;

            }

            $test_type = "0";
            $test = new test();
            $test->audio_ids = implode(',', $audio_ids);
            $test->test_type = $test_type;
            $test->paid_type = $paid_type;
            $test->save();
        }
        return redirect('listening')->with('success', 'Audio questions added successfully');
    }










}
























// Process the audio links
// $audioids = [];

// $audioLinks = $request->file('audio_link');
// $questionsData = $request->input('questions');

// if ($audioLinks && is_array($audioLinks) && $questionsData && is_array($questionsData)) {
//     foreach ($audioLinks as $index => $videoFile) {
//         if ($audioFile) {
//             $audioPath = $audioFile->store('public/assets/audio');

//             // Save the audio file and other data if needed
//             $audio = Audio::create(['audio_link' => $audioPath, 'time' => $request->input('time')]);

//             // Process the associated questions for this audio
//             $questionData = $questionsData[$index] ?? null;

//             if ($questionData && is_array($questionData)) {
//                 foreach ($questionData as $question) {
//                     // Handle the 'que_audio' for the question
//                     $queAudioFile = $question['que_audio'];
//                     if ($queAudioFile) {
//                         $queAudioPath = $queAudioFile->store('public/assets/audio');
//                     } else {
//                         $queAudioPath = null;
//                     }

//                     // Create a new Question model for each question
//                     $questionModel = new question();
//                     $questionModel->que_audio = $queAudioPath;
//                     $questionModel->question = $question['text'];
//                     $questionModel->options = json_encode($question['options']);
//                     $questionModel->answer = $question['answer'];
//                     $questionModel->save();
//                 }

//                 $audioids[] = $audio->id;
//             }
//         }
//     }
// }


