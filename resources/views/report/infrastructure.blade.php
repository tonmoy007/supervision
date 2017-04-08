<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table, td, th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            height: 50px;
        }
    </style>
    <meta charset="utf-8">
    <style>
        *{ font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; }
    </style>
</head>
<body>

<h2>The width and height Properties</h2>
<p>Set the width of the table, and the height of the table header row:</p>

<table>
    <tr>
        <th>সীমানা প্রাচীর নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>শিক্ষার্থীদের টয়লেট নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>শিক্ষার্থীদের নিরাপদ পানীয় জলের ব্যবস্থা নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>পর্যাপ্ত শ্রেণীকক্ষ নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
    </tr>
    <tr>
        @foreach($data as $d)
        <td>{{ $d }}</td>
        @endforeach
    </tr>
</table>

</body>
</html>
