<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: aqua;
        }

        .kotak {
            margin: 50px auto;
            width: 300px;
            border: 3px solid black;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h2 {
            text-align: center;
            margin: 50px;
        }
    </style>
</head>

<body>
    <h2>Halaman Login</h2>
    <div class="kotak">
        <form action="/admin/valid" method="POST">
            <div class="form-group">
                <label for="username">username</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</body>

</html>