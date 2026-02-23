<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">

    <h2>New Message from {{ config('app.name') }}</h2>

    <p>You have received a new contact form submission.</p>

    <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Message:</strong></p>
        <blockquote style="border-left: 4px solid #ccc; padding-left: 10px; color: #555;">
            {{ nl2br(e($data['message'])) }}
        </blockquote>
    </div>

    <p style="font-size: 12px; color: #888; margin-top: 20px;">
        This email was sent from your portfolio website.
    </p>

</body>
</html>
