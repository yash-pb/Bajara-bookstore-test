<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password Mail</title>
</head>
<body>
    <p>Click below button to reset password</p>
    <a href="{{ env('APP_TEST_URL').'/change-password/'.$token }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">Send Mail</a>
</body>
</html>