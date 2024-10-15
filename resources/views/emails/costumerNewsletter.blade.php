<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter</title>
    <style>
        /* Global styles for the email */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #1d1d1c;
            /* color-primary */
        }

        .email-container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-header img {
            width: 150px;
            /* Adjust the logo size */
        }

        .email-body {
            padding: 20px 0;
            text-align: center;
        }

        .email-body h1 {
            font-size: 24px;
            color: #1d1d1c;
            /* color-primary */
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666666;
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e7cd1c;
            /* color-secondary */
            color: #1d1d1c;
            /* color-primary */
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .cta-button:hover {
            background-color: #d4b517;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-content">
            <!-- Header with Logo -->
            <div class="email-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>

            <!-- Body Content -->
            <div class="email-body">
                <h1>{{ $title }}</h1>
                <p>{{ $content }}</p>

                <!-- Optional Call to Action button -->
                <div style="text-align: center; margin-top: 20px;">
                    <a href="{{ $ctaUrl }}" class="cta-button">En savoir plus</a>
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p>Vous recevez cet email car vous êtes abonné à notre newsletter.</p>
                <p><a href="{{ $unsubscribeUrl }}" style="color: #1d1d1c;">Se désinscrire</a></p>
            </div>
        </div>
    </div>
</body>

</html>
