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

    <style>
        body { font-family: 'siyam'; }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<p>ভৌত অবকাঠামোগত সুবিধাবঞ্চিত প্রতিষ্ঠানসমূহের তথ্য (সংখ্যা)</p>

<table>
    <tr>
        <th>সীমানা প্রাচীর নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>শিক্ষার্থীদের টয়লেট নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>শিক্ষার্থীদের নিরাপদ পানীয় জলের ব্যবস্থা নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>পর্যাপ্ত শ্রেণীকক্ষ নেই এরূপ প্রতিষ্ঠানের সংখ্যাঃ</th>
    </tr>
    <tr>
        @foreach($infrastucture as $d)
        <td>{{ $d }}</td>
        @endforeach
    </tr>
</table>

<p>রিপোর্টিং মাসে পিবিএম বাস্তবায়ন সংক্রান্ত তথ্যঃ</p>
<p>(ক)</p>
<table>
    <tr>
        <th>প্রতিষ্ঠান প্রধানের রেজিস্টার</th>
        <td>সম্পূর্ণ হালনাগাদ হয়েছে এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$completeRegister}}</td>
        <td>আংশিক হালনাগাদ হয়েছে এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$partialyRegister}}</td>
        <td>হালনাগাদ হয়নি এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$noRegister}}</td>
    </tr>
    <tr>
       <th>শিক্ষকের ডায়েরি</th>
        <td>সম্পূর্ণ হালনাগাদ করে এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$totalTeacherDiary}}</td>
        <td>আংশিক হালনাগাদ করে এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$partialyTeacherDiary}}</td>
        <td>হালনাগাদ করেনি এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$noTeacherDiary}}</td>
    </tr>
    <tr>
        <th>পিবিএম বাস্তবায়ন বিষয়ে পূর্ববর্তী পরিদর্শনে প্রদত্ত সুপারিশের অগ্রগতি</th>
        <td>সম্পূর্ণ বাস্তবায়নকারী শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$totalImplement}}</td>
        <td>আংশিক বাস্তবায়নকারী শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$partialyImplement}}</td>
        <td>বাস্তবায়ন হয়নি শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ {{$noImplement}}</td>
    </tr>
</table>

<p>(খ) পঞ্চবার্ষিক / বার্ষিক উন্নয়ন সংক্রান্ত তথ্যঃ </p>


<table>
    <tr>
        <th>উন্নয়ন পরিকল্পনা</th>
        <th>পরিকল্পনা প্রস্তুত করে এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ</th>
        <th>পরিকল্পনা প্রস্তুত করেনি এরূপ শিক্ষা প্রতিষ্ঠানের সংখ্যাঃ</th>
    </tr>
    <tr>
        <th>পঞ্চবার্ষিক</th>
        @foreach($fiveyearly as $d)
            <td>{{ $d }}</td>
        @endforeach
    </tr>
    <tr>
        <th>বার্ষিক</th>
        @foreach($yearly as $d)
            <td>{{ $d }}</td>
        @endforeach
    </tr>
</table>


</body>
</html>
