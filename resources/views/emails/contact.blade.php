<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Support Client</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        h2 {
            color: #0056b3;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        .message-content {
            white-space: pre-wrap;
            /* Conserve la mise en forme des retours à la ligne */
            background-color: #f0f0f0;
            padding: 15px;
            border-left: 4px solid #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Nouveau message de contact</h2>

        <div class="details">
            <p><strong>Nom :</strong> {{ $name }}</p>
            <p><strong>Email :</strong> {{ $email }}</p>
            <p><strong>Sujet :</strong> {{ $subject }}</p>
        </div>

        <h3>Message :</h3>
        <div class="message-content">
            <p>{{ $user_message }}</p>
        </div>
    </div>
</body>

</html>
