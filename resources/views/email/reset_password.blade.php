<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">

    <title>Forgot password</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear User</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Click on the below link to reset your password</td>
        </tr>
        <tr>
            <td>
                <a href="{{url('user/reset-password/'.$code)}}">Reset password</a>
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
