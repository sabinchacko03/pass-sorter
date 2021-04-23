<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Pass Sorter</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                        <h1 class="display-4 text-center mb-5">Pass Sorter</h1>
                        @csrf
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($result = Session::get('result'))
                        <div class="mb-5">
                            <ul class="list-group">
                                @foreach($result as $row)
                                    <li class="list-group-item">{{$row}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <p><strong> Upload a valid JSON file with random routes</strong><p>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="chooseFile">
                            <label class="custom-file-label" for="chooseFile">Select file</label>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                            Upload JSON File
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3">
                    <p class="text-center"><h3 class="text-center">OR</h3></p>
                    <form action="{{route('jsonForm')}}" method="post">
                        @csrf
                        <div class="form-group text-center">
                            <label for="exampleFormControlTextarea1">Paste the valid JSON array</label>
                            <textarea class="form-control" name="json" id="exampleFormControlTextarea1" rows="8"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                            Find Route
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    </body>
</html>
