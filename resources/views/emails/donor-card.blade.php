<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Donor Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0; padding: 0;
            background-color: #f7f7f7;
        }
        .card-container {
            width: 80%;
            max-width: 600px;
            margin: 40px auto;
            background-color: #9c0f3f;
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
        }
        .header h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 5px;
            line-height: 1.2;
        }
        .header h2 {
            font-size: 20px;
            font-weight: normal;
            margin-top: 0;
        }
        .details-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .detail-item {
            flex: 1 1 calc(50% - 20px);
            min-width: 250px; /* Adjust as needed */
        }
        .detail-item label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .detail-value {
            border-bottom: 1px solid white; /* For the blank line effect */
            padding-bottom: 3px;
            font-size: 16px;
        }
        .detail-value.empty-line {
            min-height: 1.2em; /* Ensure visible line even if data is missing */
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="header">
            <h1>PHILIPPINE NETWORK</h1>
            <h2>for ORGAN SHARING</h2>
        </div>
        
        <div class="details-grid">
            <div class="detail-item">
                <label>Name:</label>
                <div class="detail-value">{{ $donor->first_name ?? '' }} {{ $donor->middle_name ?? '' }} {{ $donor->last_name ?? '' }}</div>
            </div>
            <div class="detail-item">
                <label>Age:</label>
                <div class="detail-value">{{ $donor->age ?? '' }}</div>
            </div>
            <div class="detail-item">
                <label>Gender:</label>
                <div class="detail-value">{{ $donor->gender ?? '' }}</div>
            </div>
            <div class="detail-item">
                <label>Blood Type:</label>
                <div class="detail-value">{{ $donor->blood_type ?? '' }}</div>
            </div>
            <div class="detail-item">
                <label>Email Address:</label>
                <div class="detail-value">{{ $donor->contact_information ?? '' }}</div>
            </div>
            <div class="detail-item">
                <label>Contact No.:</label>
                <div class="detail-value">{{ $donor->contact_number ?? '' }}</div>
            </div>
            <div class="detail-item">
                <label>Govt ID:</label>
                <div class="detail-value">{{ $donor->goverment_id_number ?? '' }}</div>
            </div>
        </div>
    </div>
</body>
</html> 