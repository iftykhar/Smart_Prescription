<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Document</title>
</head>
<body>
<div>
    test upate
</div>
<br>
    <div class="col-1"></div>
    <div class="col-10">
        <form method="post" action="{{route('doctor.store')}}" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" name="degree" class="form-control" placeholder="degree">
            </div>
            <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="phone">
            </div>
            <div class="form-group">
                <input type="text " name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="address" class="form-control" placeholder="address">
            </div>
            <button class="btn btn-info" type="submit" value="submit" > Save</button>
        </form>

    </div>
    <div class="col-1"></div>

</body>
</html>
