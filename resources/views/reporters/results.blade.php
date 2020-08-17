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

    <h3>Resultados</h3>
    <table style="width: 100%" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <th class="bg-dark">Lista</th>
            <th class="bg-dark">Nom. Votos</th>
        </tr>
            @foreach ($ranking as $item)
            <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->point ?  $item->point .' Votos' : 0 . ' Votos'}}</td>
            </tr>
            @endforeach
        </table>

    <h3>Padron Electoral: {{$totalVoters}} Personas</h3>
    <h3>Han votado: {{$haveVoted}} Personas</h3>
    <h3>No han Hotado: {{$haveNotVoted}} Personas</h3>

    <table>
        <tr>
            @foreach ($users as $user)
        <td> ___________________ <br> <b>{{$user->name}}</b> <br> {{$user->username}}</td>
            @endforeach
        </tr>
    </table>
</body>
</html>
