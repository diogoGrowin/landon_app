@extends('layouts.app')

@section('content')

<div class="row">
      <div class="medium-6 large-5 columns">
        <form method="POST" enctype="multipart/form-data"> 
         {{ csrf_field() }}
            <input type="file" name="image_upload" />
            <small class="error">{{ $errors->first('image_upload') }}</small>
            <!-- <small class="error">{{ var_dump($errors) }}</small> -->
<!--             @foreach ($errors->all() as $error)
                <small class="error">{{ $error }}</small>
            @endforeach  -->
            <input type="submit" value="upload" class="button success hollow" />
        </form>
      </div>
    </div>

@endsection