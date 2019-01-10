<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\LessonPart;
use Validator;
use Session;
use Illuminate\Http\Request;

use App\Http\Requests;

class LessonPartController extends Controller
{

    public function store(Request $request){

        $data = $request->all();
        $rules = [
            'seconds' => 'required|numeric',
            'presentation' => 'required|file|mimes:pdf',
            'audio' => 'file|mimes:mpga,wav',
            'video' => 'file|mimes:mp4,mov,avi,wmv',
            'lesson_id' => 'required|numeric',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $lessonPart = new LessonPart();
            $presentation = $request->presentation;
            $presentation_new_name = time() . $presentation->getClientOriginalName();
            $presentationFullPath = $presentation->move('assets/files/lessons/presentations', $presentation_new_name);
            $lessonPart->presentation = $presentationFullPath;
            if($request->audio){
                $audio = $request->audio;
                $audio_new_name = time() . $audio->getClientOriginalName();
                $audioFullPath = $audio->move('assets/files/lessons/audios', $audio_new_name);
                $lessonPart->audio = $audioFullPath;
            }
            if($request->video){
                $video = $request->video;
                $video_new_name = time() . $video->getClientOriginalName();
                $videoFullPath = $video->move('assets/files/lessons/videos', $video_new_name);
                $lessonPart->video = $videoFullPath;
            }
            $lessonPart->lesson_id = $request->lesson_id;
            $lessonPart->seconds = $request->seconds;
            $lessonPart->save();
            Session::flash('success', ['title' => 'Успешно!' , 'body' =>'Часть урока сохранена!']);
            return redirect()->back();
        }

    }

    public function index($id){
        $lesson = Lesson::findOrFail($id);
        return view('lesson.create_part', compact('lesson'));
    }
}
