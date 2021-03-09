<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <title>Index</title>
</head>
<body>

<div class="col-1"></div>
<div class="col-10">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">name</th>
            <th scope="col">degree</th>
            <th scope="col">phone</th>
            <th scope="col">email</th>
            <th scope="col">address</th>
        </tr>
        </thead>
        @foreach($doc as $data)
            <tbody>
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->degree}}</td>
                <td>{{$data->phone}}</td>
                <td>{{$data->email}}</td>
                <td>{{$data->address}}</td>
                <td>
                    <a href="{{ route('doctor.edit', $data->id) }}" class="btn btn-secondary">Edit</a>
                    <a href="{{ route('doctor.show', $data->id) }}" class="btn btn-warning">Show</a>
                    <form action="{{ route('doctor.destroy', $data->id) }}" method="">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger float-right" type="submit" onclick="return confirm('Sure you want to delete this data?')">Delete</button>
                    </form>
                </td>
            </tr>

            </tbody>
        @endforeach
    </table>
</div>
<div class="col-1"></div>

</body>
</html>
