<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Donor Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .card {
            border: 2px solid #000;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .detail-row {
            margin-bottom: 10px;
        }
        .label {
            display: inline-block;
            width: 200px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">Philippine Network for Organ Sharing</div>
        
        <div class="detail-row">
            <span class="label">Name:</span>
            {{ $donor->first_name }} {{ $donor->middle_name }} {{ $donor->last_name }}
        </div>
        
        <div class="detail-row">
            <span class="label">Age:</span>
            {{ $donor->age }}
        </div>
        
        <div class="detail-row">
            <span class="label">Gender:</span>
            {{ $donor->gender }}
        </div>
        
        <div class="detail-row">
            <span class="label">Blood Type:</span>
            {{ $donor->blood_type }}
        </div>
        
        <div class="detail-row">
            <span class="label">Time of Registration:</span>
            {{ $donor->created_at->format('F d, Y h:i A') }}
        </div>
        
        <div class="detail-row">
            <span class="label">Organ Needed:</span>
            {{ $donor->organ_needed }}
        </div>
        
        <div class="detail-row">
            <span class="label">Government ID Issued number:</span>
            {{ $donor->goverment_id_number }}
        </div>
    </div>
</body>
</html> 