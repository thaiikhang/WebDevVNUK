<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- MAIN CSS  -->
    <link rel="stylesheet" href="/css/simpleForm.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sign Up Validate</title>
  </head>
  <body>
    <div class="container">
        <form method="post">
            @csrf 
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="text" class="form-control" name="age">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="text" class="form-control" name="date">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label>Web</label>
                <input type="text" class="form-control" name="web">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" class="form-control" name="address">
            </div>
            <div>
                @include('blocks.error')
            </div>
            <button type="submit" class="btn btn-primary">OK</button>
            
            <div class="display-info">
                @if(isset($user))
                    <p>Name: {{$user['name']}}</p>
                    <p>Age: {{$user['age']}}</p>
                    <p>Date: {{$user['date']}}</p>
                    <p>Phone: {{$user['phone']}}</p>
                    <p>Phone: {{$user['web']}}</p>
                    <p>Address: {{$user['address']}}</p>
                @endif
            </div>
            
        </form>
    </div>


    <!-- BS5  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>