<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-size: 8pt;
        }
        .bg-dark {
            background-color: #cfcfcf
        }
    </style>
</head>
<body>
    <img src="{{public_path('/images/logo.png')}}" alt="">
    <h2 style="text-align:center">{{config('app.name')}}</h2>
    <h3 style="text-align:center">Elecciones 2020-2022</h3>
    <table cellspacing="0" cellpadding="0" border="1">
        <tr>
            <th class="bg-dark">Cédula</th>
            <th class="bg-dark">Nombres</th>
                <th class="bg-dark">Correo ele</th>
                <th class="bg-dark">Ha Votado</th>
                <th class="bg-dark">
                Observación</th>
        </tr>
        @foreach ($voters as $voter)
        <tr>
        <td>{{$voter->identification}}</td>
        <td>{{$voter->name}}</td>
        <td>{{$voter->email}}</td>
        <td>{{$voter->enabled == '0' ?  'Si' : 'No'}}</td>
        <td>{{$voter->observation == 'notificated' ?  'Notificado por correo' : 'No ha sido notificado'}}</td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr>
            @foreach ($users as $user)
        <td> ___________________ <br> <b>{{$user->name}}</b> <br> {{$user->username}}</td>
            @endforeach
        </tr>
    </table>
</body>
</html>
