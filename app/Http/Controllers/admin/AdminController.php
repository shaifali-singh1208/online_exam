<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\Models\Audio;
use App\Models\test;
use App\Models\para;
use App\Models\celpip;
use App\Models\Transaction;
use App\Models\question;
use session;

class AdminController extends Controller
{
    public function home()
    {
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {
            return view('admin.index');
        }
    }

    public function alltest()
    {
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {
            return view('admin.Admin_all_test');

        }


    }
    public function test1(Request $request)
    {
        $request->validate([
            'paid_type' => 'required',
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

        $test_type = '2';
        $test = new test();
        $test->question_ids = implode(',', $questionIds);
        $test->test_type = $test_type;
        $test->paid_type = $paid_type;
        if ($test->save()) {
            return view('admin.speaking.speaking_testall', compact('test'))->
                with('success', ' Speaking test Add successfully');
        } else {
            return redirect()->back()->with('failed', 'Unable to update data');
        }
    }

    // public function test_1( ){
//     $data = test::where('test_type', 2)->latest()->first();

    //     return view('admin.speaking.speaking_testall',compact('data'));
// }



    public function test2(Request $request)
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
        $test_id = [];
        $test_id[] = $request->test_id;
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


            $newQuestion->img1 = $publicUrl ?? null;
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
        // $test->save();

        if ($test->save()) {
            $test_id[] = $test->id;
            return view('admin.listening.listening_test', compact('test_id'))->with('success', ' Listening test Add successfully');

        } else {
            return redirect()->back()->with('failed', 'Unable to update data');
        }

    }







    // public function test_2(){

    //     $data = test::whereIn('test_type', [ '2','3'])->latest()->pluck('id')->toArray();
    //     return view('admin.listening.listening_test',compact('data'));
    // }




    public function test3(Request $request)
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
            $test_id[] = $request->test_id_witting;
            $test_id[] = $request->test_id_speaking;

            foreach ($audiosData as $index => $audioData) {
                $audio = new Audio();

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




                // $audio->audio_link = $publicUrl;

                $audio->time = $audioData['time'];

                //  $audio->save();

                $questionIds = [];

                // Handle audio questions
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

                        // Associate the question with the audio
                        // $audio->questions()->save($question);

                        // Store the question ID for later use
                        $questionIds[] = $question->id;
                    }
                }

                // Update the audio record with associated question IDs
                $audio->question_ids = implode(',', $questionIds);
                $audio->save();
                $audio_ids[] = $audio->id;

            }

            $test_type = "0";
            $test = new test();
            $test->audio_ids = implode(',', $audio_ids);
            $test->test_type = $test_type;
            $test->paid_type = $paid_type;

            if ($test->save()) {
                $test_id[] = $test->id;
                return view('admin.paragraph.paragraph_test', compact('test_id'))->
                    with('success', ' Reading test Add successfully');

            } else {
                return redirect()->back()->with('failed', 'Unable to update data');
            }

        } else {
            return redirect()->back()->with('failed', 'Audios are missing');
        }

    }


    public function test4(Request $request)
    {
        $request->validate([
            'paid_type' => 'required',
        ]);

        $paragraphsData = $request->input('paragraphs');
        $time = $request->input('time');
        $paid_type = $request->input('paid_type');
        $test_id = [];
        $paragraphIds = [];
        $test_id[] = $request->test_id_witting;
        $test_id[] = $request->test_id_speaking;
        $test_id[] = $request->test_id_listening;

        foreach ($paragraphsData as $index => $paragraphData) {
            $questionIds = [];
            $imageFileName = null;

            if ($request->hasFile('paragraphs.' . $index . '.para_img')) {
                $image = $request->file('paragraphs.' . $index . '.para_img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/uploads'), $imageName);
                $publicUrl = url('assets/uploads/' . $imageName); // Use the url() function

                $imageFileName = $publicUrl;
            }
            $questionData = $paragraphData['questions'];

            foreach ($questionData as $question) {
                $newQuestion = new question();
                $newQuestion->question = $question['text'];
                $newQuestion->time = isset($time[$index]) ? $time[$index] : null;
                $newQuestion->options = json_encode(array_values($question['options']));
                $newQuestion->answer = $question['answer'];
                $newQuestion->save();
                $questionIds[] = $newQuestion->id;
            }

            $paragraph = new para();
            $paragraph->paragraph = $paragraphData['text'];
            $paragraph->para_img = $imageFileName;
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
        $test_id[] = $test->id;

        $celpiph = new Celpip();
        $celpiph->test_ids = implode(',', $test_id);
        $celpiph->paid_type = $paid_type;
        $celpiph->save();
        return redirect('home')->with('success', 'All Test   added successfully');


    }


    public function transaction_detail()
    {

        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return view('admin.Transaction', compact('transactions'));
    }


}






