<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        .job-card {
            background: #fff;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .logo {
            width: 64px;
            height: 64px;
            object-fit: contain;
            border-radius: 5px;
            margin-right: 20px;
            background: #f0f0f0;
        }

        .job-info {
            flex: 1;
        }

        .position {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company {
            color: #555;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .date {
            color: #888;
            font-size: 12px;
        }

        a.button {
            display: inline-block;
            margin-top: 10px;
            background: #007bff;
            color: #fff;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        a.button:hover {
            background: #0056b3;
        }
    </style>
    <title>JobFlow</title>
</head>
<body>
<h2>🔥 New Job Opportunities</h2>

@foreach($jobs as $job)
    <div class="job-card">
        <img class="logo" src="{{ $job->getCompanyLogo() }}" alt="{{ $job->getCompany() }} Logo"/>
        <div class="job-info">
            <div class="position">{{ $job->getName() }}</div>
            <div class="company">{{ $job->getCompany() }}</div>
            <div class="date">Posted on {{ $job->getDate() }}</div>
            <a class="button" href="{{ $job->getUrl() }}" target="_blank">View Job</a>
        </div>
    </div>
@endforeach

<a class="button" href="{{ route('dashboard') }}" target="_blank">Show more on JobFlow</a>

<p style="font-size: 12px; color: #999; margin-top: 30px;">
    You’re receiving this email because you subscribed to jobFlow.
</p>
</body>
</html>
