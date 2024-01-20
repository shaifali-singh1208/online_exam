<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\para;
use App\Models\question;
use Illuminate\Http\Request;
use App\Models\celpip;
use App\Models\test;
use App\Models\Audio;
use App\Models\written;

class TestController extends Controller
{
    public function all_test(){
        if (!session()->has('userDetails')) {
            return redirect('/');
        } else {
        $para = celpip::get();
        return view("admin.allTest",compact("para"));
    }

    }
    public function all_para($id) {
        $data = celpip::findOrFail($id);
        $testIds = explode(',', $data->test_ids);
    
        // Find all test records with IDs in the $testIds array
        $tests = test::whereIn('id', $testIds)->get();
        return view("admin.test_type", compact("tests"));
    }

    public function getListeningTest($test_id)
    {
        $data = test::findOrFail($test_id);
        $questionIds = explode(',', $data->audio_ids);
        $listen = Audio::where('id', $questionIds)->get();
        return view('admin.listening.listeningEdit', compact('listen','data'));
    }

    public function edit_listen_que($ques_id){
        $data = Audio::findOrFail($ques_id);
        $questionIds = explode(',', $data->question_ids);
   
           $questions = question::whereIn('id', $questionIds)
           ->select('id', 'question', 'que_audio', 'options', 'time', 'answer')
           ->get();
       return view('admin.listening.listenEdit', compact('data','questions'));
   

    }

    public function edit_listening_Ques(Request $request){
        $userData = [];

    if (!empty($request->input('time'))) {
        $userData['time'] = $request->input('time')[0]; 
    }

    if ($request->hasFile('audio_link')) {
        $image = $request->file('audio_link')[0]; 
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/audio'), $imageName);
        $publicUrl = url('assets/audio/' . $imageName);

        $userData['audio_link'] = $publicUrl;
    }
    

    Audio::where('id', $request->id)->update($userData);

    return redirect()->back()->with('success', 'Listening question updated successfully.');
}
    


public function edit_listen_question(Request $request){
    $userData = [];
    
    if (
        $request->filled('question') &&
        $request->filled('options') &&
        $request->filled('time') &&
        $request->filled('answer')
    ) {
        $userData['question'] = $request->question[0] ?? '';
        $userData['options'] = json_encode($request->options);
        $userData['time'] = $request->time[0] ?? '';
        $userData['answer'] = $request->answer[0] ?? '';
    }

    question::where('id', $request->id)->update($userData);
    return redirect()->back()->with('success', 'Question updated successfully.');
}

public function editlisteningTest($ques_id){
    $data = question::findOrFail($ques_id);
   $test= Audio::get();
return view('admin.listening.edit_listen_ques', compact('data','test'));    

}
public function listen_ques($id){
question::where('id', "=", $id)->delete();
return redirect()->back()->with("success","listening questions delete successfully");

}



public function write_ques($id){
    question::where('id', "=", $id)->delete();
    return redirect()->back()->with("success","writting questions delete successfully");
    
    }
    public function speaking_ques($id){
        question::where('id', "=", $id)->delete();
        return redirect()->back()->with("success","speaking questions delete successfully");
        
        }
        
        
        
        public function paragraph_ques($id){
            question::where('id', "=", $id)->delete();
            return redirect()->back()->with("success","reading questions delete successfully");
            
            }




    public function getReadingTest($test_id)
    {
        $data = test::findOrFail($test_id);
        $questionIds = explode(',', $data->para_ids);
        $paragraph = para::where('id', $questionIds)->get();
        return view('admin.paragraph.paragraphEdit', compact('paragraph','data'));
    }


    public function editparagraphTest($ques_id)
    {
        $data = para::findOrFail($ques_id);
     $questionIds = explode(',', $data->question_ids);

        $questions = question::whereIn('id', $questionIds)
        ->select('id', 'question', 'options', 'time', 'answer')
        ->get();
    return view('admin.paragraph.edit_para', compact('data','questions'));

    }




    public function edit_paragraph_Ques(Request $request){
        $userData = [];
    
        if ($request->filled('paragraph')) {
            $userData['paragraph'] = $request->input('paragraph')[0]; // Assuming paragraph is a single value, adjust as needed
        }
    
        if ($request->hasFile('para_img')) {
            $image = $request->file('para_img')[0]; // Assuming only one file is expected
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/uploads'), $imageName);
            $publicUrl = url('assets/uploads/' . $imageName);
    
            $userData['para_img'] = $publicUrl;
        }
    
        para::where('id', $request->id)->update($userData);
    
        return redirect()->back()->with('success', 'Paragraph question updated successfully.');
    }
    
    



    //writtng section---
    public function getWrittingTest($test_id)
    {
        $data = test::findOrFail($test_id);
        $questionIds = explode(',', $data->question_ids);
        $writingTest = question::whereIn('id', $questionIds)->get();

    return view('admin.writting.writtingEdit', compact('writingTest','data'));
    }


    public function editQues(Request $request){
        $userData = [];

        if ($request->filled('question') && $request->filled('time')) {
            // Assuming 'question' and 'time' are arrays
            $userData['question'] = $request->question[0]; // You can adjust the index based on your form structure
            $userData['time'] = $request->time[0]; // You can adjust the index based on your form structure
        }
    
        question::where('id', $request->id)->update($userData);
    
        return redirect()->back()->with('success', 'Writing question updated successfully.');
    }



    public function editWrittingTest($ques_id)
    {
        $data = question::findOrFail($ques_id);

    return view('admin.writting.writen_ques', compact('data'));
    }



    public function getSpeakingTest($test_id)
    {
        $data = test::findOrFail($test_id);
        $questionIds = explode(',', $data->question_ids);
        $speakingTest = question::whereIn('id', $questionIds)->get();
                return view('admin.speaking.speakingEdit', compact('speakingTest','data'));
    }
    


    public function editspeakingTest($ques_id)
    {
        $data = question::findOrFail($ques_id);

    return view('admin.speaking.speak_ques', compact('data'));
    }

    public function edit_speak_Ques(Request $request)
    {
        $userData = [];
    
        if ($request->filled('question') && $request->filled('time')) {
            // Assuming 'question' and 'time' are arrays
            $userData['question'] = $request->question[0]; // You can adjust the index based on your form structure
            $userData['time'] = $request->time[0];
            $userData['prep_time'] = $request->time[0];
    
            // Handle image1
            if (isset($request->file('img1')[0]) && $request->file('img1')[0]->isValid()) {
                $imageurl = time() . $request->file('img1')[0]->getClientOriginalName();
                $request->file('img1')[0]->move(public_path() . '/assets/uploads/', $imageurl);
                $publicUrl = url('assets/uploads/' . $imageurl);
                $userData['img1'] = $publicUrl;
            }
    
            // Handle image2
            if (isset($request->file('img2')[0]) && $request->file('img2')[0]->isValid()) {
                $imageurl1 = time() . $request->file('img2')[0]->getClientOriginalName();
                $request->file('img2')[0]->move(public_path() . '/assets/uploads/', $imageurl1);
                $publicUrl1 = url('assets/uploads/' . $imageurl1);
                $userData['img2'] = $publicUrl1;
            }
    
            // Handle image3
            if (isset($request->file('img3')[0]) && $request->file('img3')[0]->isValid()) {
                $imageurl2 = time() . $request->file('img3')[0]->getClientOriginalName();
                $request->file('img3')[0]->move(public_path() . '/assets/uploads/', $imageurl2);
                $publicUrl2 = url('assets/uploads/' . $imageurl2);
                $userData['img3'] = $publicUrl2;
            }
        }
    
        question::where('id', $request->id)->update($userData);
    
        return redirect()->back()->with('success', 'speaking question updated successfully.');
    }
    


    public function edit_para_que($ques_id){
        $data = question::findOrFail($ques_id);
    
    return view('admin.paragraph.para_ques', compact('data'));    
    
    }
    



    public function edit_para_question(Request $request){

        $userData = [];
    
        if (
            $request->filled('question') &&
            $request->filled('options') &&
            $request->filled('time') &&
            $request->filled('answer')
        ) {
            $userData['question'] = $request->question[0] ?? '';
            $userData['options'] = json_encode($request->options);
            $userData['time'] = $request->time[0] ?? '';
            $userData['answer'] = $request->answer[0] ?? '';
        }
    
        question::where('id', $request->id)->update($userData);
        return redirect()->back()->with('success', 'Question updated successfully.');
    }
    
    
    










}