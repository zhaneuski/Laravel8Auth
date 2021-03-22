<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<div class="container">
    <div class="row" style="margin-top: 45px">
        <div class="col-md-4 col-md-offset-4">
            <h4>Register | Custom register</h4><br>
            <form action="{{route('auth.save')}}" method="post">


{{--                Проверяем записаны ли данные в сессию а также статус записи--}}
                @if(Session::get('success'))
{{--                Если запись прошла успешно, то выводим соотв соощение--}}
                    <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                @endif

                    @if(Session::get('fail'))
{{--                        Иначе выводим сообщение об ошибке --}}
                        <div class="alert allert-danger" role="alert">{{Session::get('fail')}}</div>
                    @endif

                @csrf
                <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input name="name" type="text" class="form-control" id="exampleInputName"
                           placeholder="enter your name" value="{{old('name')}}">
                    <span class="text-danger">@error('name'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="enter your email" value="{{old('email')}}">
                    <span class="text-danger">@error('email'){{$message}}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                           placeholder="enter your password">
                    <span class="text-danger">@error('password'){{$message}}@enderror</span>
                </div>

                <button type="submit" class="btn btn-block btn-primary">Sign up</button>
                <br>
                <a href="{{route('auth.login')}}">I already have an account, sing in</a>
            </form>
        </div>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
