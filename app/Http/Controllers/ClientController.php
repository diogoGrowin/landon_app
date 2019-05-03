<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Title as Title;                             //add title Model class to be used

use App\Client as Client;                             //add Client Model class to be used

class ClientController extends Controller
{
    //dependency injection on arguments (Client)
    public function __construct(Title $titles,  Client $client)      //argument of type of the Model class "Title"
    {
        $this->titles = $titles->all();             //call Model class "Title" and Method all
        $this->client = $client;
    }

    public function di()
    {   
        print_r($this->titles);
        echo '<br/><br/>';
        dd($this->titles);                      //dd() stands for "dump and die". display the variable content

    }

    public function index()
    {
        #return __METHOD__ ;             //return the name of the method in the class

        $data=[];

        //static data
        /* $obj = new \stdClass;
        $obj->id = 1;
        $obj->title = 'mr';
        $obj->name = 'john';
        $obj->last_name = 'doe';
        $obj->email = 'john@domain.com';
        
        $data['clients'][]= $obj;       //put the object inside the array to be sended to the view
  
        $obj = new \stdClass;
        $obj->id = 2;
        $obj->title = 'ms';
        $obj->name = 'jane';
        $obj->last_name = 'doe';
        $obj->email = 'jane@another-domain.com'; 
         $data['clients'][]= $obj;       //put the object inside the array to be sended to the view 
         */

        //dynamic data using Eloquent
        $data['clients']=$this->client->all();
       

        return view('client/index',$data);        //load to a view with parameters
    }

    public function export()
    {
        $data=[];

        //dynamic data using Eloquent
        $data['clients']=$this->client->all();  //use all() to retrive all records from DB

        //prepare download file using headers options
        header('Content-Disposition: attachment; filename=export.xls');
       
        return view('client/export',$data);        //load to a view with parameters
    }

    public function newClient( Request $request, Client $client)             //dependency injection (Request)
    {
        //return __METHOD__ ;             //return the name of the method in the class
        $data=[];

        /****** process form input ******/

        $data['title']= $request->input('title');       //catch data sended on form !!! (like $_POST)
        $data['name']= $request->input('name');
        $data['last_name']= $request->input('last_name');
        $data['address']= $request->input('address');
        $data['zip_code']= $request->input('zip_code');
        $data['city']= $request->input('city');
        $data['state']= $request->input('state');
        $data['email']= $request->input('email');

        /****** process form input ******/

        if( $request->isMethod('post'))     //check if form is submited with method post
        {   
            //dd($data);
            
            //validate data received on form, the errors and the old values are in the form
            $this->validate(
                $request,           // 1º parameter is the requested object
                [                   //2º parameter is an array
                    'name' => 'required|min:5',       // "required" make the field mandatory, min is the minimum chars
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',
                ]
            );

            //inser into DB, Using Eloquent
            $client->insert($data);

            return redirect('clients');       //redirect using route name
        }      

        $data['titles']= $this->titles;
        $data['modify']=0;                  //to mark this will not be modify, but new

        #return view('client/newClient',$data);
        return view('client/form',$data);
    }

    public function create()
    {
        //return __METHOD__ ;             //return the name of the method in the class
        return view('client/create');
    }

    public function show($client_id, Request $request)    //method with parameters from URL
    {
        //return __METHOD__ . ' : ' . $client_id;
        
        $data=[];
        $data['client_id'] = $client_id;        //passing data to select user
        $data['titles']= $this->titles;
        $data['modify']=1;                  //to mark this will be modify

        //select data with filter using Eloquent
        $client_data=$this->client->find($client_id);
        $data['name']=$client_data->name;
        $data['last_name']=$client_data->last_name;
        $data['title']=$client_data->title;
        $data['address']=$client_data->address;
        $data['zip_code']=$client_data->zip_code;
        $data['city']=$client_data->city;
        $data['state']=$client_data->state;
        $data['email']=$client_data->email;

        //sessions
        //store value of client name and last_name on a session variable named "last_updated"
        $request->session()->put('last_updated',$client_data->name . ' '.$client_data->last_name );

        #return view('client/newClient',$data);
        return view('client/form',$data);
    }

    public function modify( Request $request, $client_id, Client $client)             //dependency injection (Request)
    {
        //return __METHOD__ ;             //return the name of the method in the class
        $data=[];

        /****** process form input ******/

        $data['title']= $request->input('title');       //catch data sended on form !!! (like $_POST)
        $data['name']= $request->input('name');
        $data['last_name']= $request->input('last_name');
        $data['address']= $request->input('address');
        $data['zip_code']= $request->input('zip_code');
        $data['city']= $request->input('city');
        $data['state']= $request->input('state');
        $data['email']= $request->input('email');

        /****** process form input ******/

        if( $request->isMethod('post'))     //check if form is submited with method post
        {   
            //dd($data);
            
            //validate data received on form, the errors and the old values are in the form
            $this->validate(
                $request,           // 1º parameter is the requested object
                [                   //2º parameter is an array
                    'name' => 'required|min:5',       // "required" make the field mandatory, min is the minimum chars
                    'last_name' => 'required',
                    'address' => 'required',
                    'zip_code' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'email' => 'required',
                ]
            );

           //update into DB, Using Eloquent
           $client_data = $this->client->find($client_id);

           $client_data->title = $request->input('title');       //catch data sended on form !!! (like $_POST)
           $client_data->name = $request->input('name');
           $client_data->last_name = $request->input('last_name');
           $client_data->address = $request->input('address');
           $client_data->zip_code = $request->input('zip_code');
           $client_data->city = $request->input('city');
           $client_data->state = $request->input('state');
           $client_data->email = $request->input('email');

           $client_data->save();


            return redirect('clients');       //redirect using route name
        }      

        $data['titles']= $this->titles;
        $data['modify']=0;                  //to mark this will not be modify, but new

        #return view('client/newClient',$data);
        return view('client/form',$data);
    }
}
