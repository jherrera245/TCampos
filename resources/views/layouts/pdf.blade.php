<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <style type="text/css">
        *{
            font-family: "Helvetica Neue",Helvetica,Arial;
            font-size: 10pt;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            page-break-inside: avoid;
            border-collapse: collapse;
        }

        tr{
            border: 1px solid #ccc;
        }

        th, td{
            padding: 3px;
            border: 1px solid #ccc;
        }

        tr, th, td {
            page-break-inside: avoid;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }

        tr:nth-child(even) {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    @yield('cuerpo-pdf')
</body>
</html>