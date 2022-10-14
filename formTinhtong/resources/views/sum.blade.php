<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- MAIN CSS  -->
    <link rel="stylesheet" href="/css/sum.css">

    <title>Form Tinh Tong</title>
</head>

<body>
    <form class="formTinhtong my-3" method="post">
        @csrf
        <div class="mb-3 mx-5">
            <label for="formGroup" class="form-label">Enter so A</label>
            <input type="number" class="form-control" id="formGroup" name="soA">
        </div>
        <div class="mb-3 mx-5">
            <label for="formGroup2" class="form-label">Enter so B</label>
            <input type="number" class="form-control" id="formGroup2" name="soB">
        </div>
        <button type="submit" class="btn btn-outline-primary mb-3 mx-5">Submit</button>
        <div class="mb-3 mx-5">
            <label for="formGroup3" class="form-label">Ket qua</label>
            <input type="number" class="form-control" id="formGroup3" disabled value="<?php if(isset($sum)) echo $sum; ?>">
        </div>
    </form>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>