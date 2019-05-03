<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;   //for file upload input

class ContentsController extends Controller
{
    //

    public function home(Request $request)      //dependency injection
    {
        //return __METHOD__ ;
        $data=[];                           //array to send data to the view
        $data['version'] = '0.1.2';

        //retrive data from session
        $last_updated = $request->session()->has('last_updated') ? $request->session()->pull('last_updated') : 'none';

        //put session data to the view
        $data['last_updated']=$last_updated;

        return view('contents/home',$data);     //send data to the view 
    }


    public function upload(Request $request)      //dependency injection
    {
        $data=[];                           //array to send data to the view

        //if( $request->isMethod('post') && $request->hasFile('image_upload') )      //check if file is being send from post method
        if( $request->isMethod('post'))
        {
            $this->validate(
                $request,                                       //validate the request content
                [
                    'image_upload' => 'required|mimes:jpeg,bmp,png'      //allowed file types
                ],

                //custom messages for errors
                [   
                    //<object_file>.<property>
                    'image_upload.required'  =>  'Por favor escolha 1 ficheiro'
                ]
            );

            //move file for temp location to permanent location
            Input::file('image_upload')->move('images','attractions.jpg');
            return redirect('/');   //redirect home

        }/* elseif($request->isMethod('post') && !$request->hasFile('image_upload'))
        {
            //return redirect('/upload')->with('message', 'No file');   //not working
            //return redirect::back()->withErrors('error!');
           // return redirect()->back()->withErrors('errors', 'No file 123');
           return back()->withErrors("image_upload", "No file 123");
        }
 */
        return view('contents/upload',$data);     //send data to the view 
    }
}
