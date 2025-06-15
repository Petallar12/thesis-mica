<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Registering</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #9c0f3f;">Thank You for Registering as a Donor</h2>
        
        <p>Dear {{ $donor->first_name }},</p>
        
        <p>Thank you for registering with the Philippine Network for Organ Sharing. Your commitment to potentially helping others through organ donation is deeply appreciated.</p>
        
        <p>We have received your registration with the following details:</p>
        <ul>
            <li>Name: {{ $donor->first_name }} {{ $donor->middle_name }} {{ $donor->last_name }}</li>
            <li>Blood Type: {{ $donor->blood_type }}</li>
            <li>Organ: {{ $donor->organ_needed }}</li>
        </ul>
        
        <p>We will keep your information secure and confidential. If you have any questions or need to update your information, please don't hesitate to contact us.</p>

        <!-- Donor Details Card -->
        <div style="border: 2px solid #000; padding: 20px; margin: 20px 0;">
            <h3 style="text-align: center; margin-bottom: 20px;">Philippine Network for Organ Sharing</h3>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Name:</span>
                {{ $donor->first_name }} {{ $donor->middle_name }} {{ $donor->last_name }}
            </div>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Age:</span>
                {{ $donor->age }}
            </div>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Gender:</span>
                {{ $donor->gender }}
            </div>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Blood Type:</span>
                {{ $donor->blood_type }}
            </div>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Time of Registration:</span>
                {{ $donor->created_at->format('F d, Y h:i A') }}
            </div>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Organ Needed:</span>
                {{ $donor->organ_needed }}
            </div>
            
            <div style="margin-bottom: 10px;">
                <span style="display: inline-block; width: 200px;">Government ID Issued number:</span>
                {{ $donor->goverment_id_number }}
            </div>
        </div>
        
        <p>Best regards,<br>
        Philippine Network for Organ Sharing Team</p>
    </div>
</body>
</html> 