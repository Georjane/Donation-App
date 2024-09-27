<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Campaigns</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8fafc;
            color: #374151;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        .campaign-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px 0;
            transition: transform 0.3s;
        }
        .campaign-card:hover {
            transform: translateY(-5px);
        }
        .donate-button {
            background-color: #FF2D20;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .donate-button:hover {
            background-color: #e5241c;
        }
        .alert {
            color: #FF2D20;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Campaigns</h1>
        
        @if ($campaigns->isEmpty())
            <p class="text-center">No campaigns available at the moment.</p>
        @else
            @foreach ($campaigns as $campaign)
                <div class="campaign-card">
                    <h3>{{ $campaign->name }}</h3>
                    <p><strong>Target Amount:</strong> ${{ number_format($campaign->target_amount, 2) }}</p>
                    <p><strong>Raised Amount:</strong> ${{ number_format($campaign->current_amount, 2) }}</p>
                    @if ($campaign->status === 'open')
                        @if (auth()->check())
                            <form method="POST" action="{{ route('donate', $campaign->id) }}">
                                @csrf
                                <button type="submit" class="donate-button">Donate</button>
                            </form>
                        @else
                            <button class="donate-button" onclick="alert('Please sign in to donate!')">Donate</button>
                        @endif
                    @else
                        <p class="alert">This campaign is closed.</p>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
