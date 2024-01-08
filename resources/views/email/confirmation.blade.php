<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">

    <title>Register</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear {{$name}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Click on the below link to activate your account</td>
        </tr>
        <tr>
            <td>
                <a href="{{url('user/confirm/'.$code)}}">Confirm Account</a>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Thanks you</td>
        </tr>
    </table>
</body>
</html>
