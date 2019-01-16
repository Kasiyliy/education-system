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
            'presentation' => 'required|file|mimes:jpg , pdf',
            'information' => 'required',
            'audio' => 'file|mimes:mpga,wav,mp3',
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
            $lessonPart->information = $request->information;
            $lessonPart->save();
            Session::flash('success', ['title' => 'Успешно!' , 'body' =>'Часть урока сохранена!']);
            return redirect()->back();
        }

    }

    public function index($id){
        $lesson = Lesson::findOrFail($id);
        return view('lesson.create_part', compact('lesson'));
    }

    public function destroy($id){
        $lessonPart = LessonPart::findOrFail($id);
        $lessonPart->delete();
        Session::flash('success', ['title' => 'Успешно!' , 'body' =>'Часть урока удалена!']);
        return redirect()->back();
    }

    public function edit($id){
        $lessonPart = LessonPart::findOrFail($id);
        return view('lesson.edit_part', compact('lessonPart'));
    }

    public function update(Request $request, $id){

        $data = $request->all();
        $rules = [
            'seconds' => 'required|numeric',
            'presentation' => 'required|file|mimes: jpg , pdf',
            'information' => 'required',
            'audio' => 'file|mimes:mpga,wav,mp3',
            'video' => 'file|mimes:mp4,mov,avi,wmv',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }else{
            $lessonPart = LessonPart::findOrFail($id);

            if(file_exists($lessonPart->presentation)){
                unlink($lessonPart->presentation);
            }

            if($lessonPart->audio){
                if(file_exists($lessonPart->audio)){
                    unlink($lessonPart->audio);
                }
            }

            if($lessonPart->video){
                if(file_exists($lessonPart->video)){
                    unlink($lessonPart->video);
                }
            }


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
            $lessonPart->seconds = $request->seconds;
            $lessonPart->information = $request->information;
            $lessonPart->save();
            Session::flash('success', ['title' => 'Успешно!' , 'body' =>'Часть урока обновлена!']);
            return redirect()->route('lesson.show', ['id' => $lessonPart->lesson_id]);
        }
    }
}
