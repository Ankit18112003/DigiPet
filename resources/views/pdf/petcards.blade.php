<!DOCTYPE html>
<html>
<head>
    <title>Pet Details PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url("{{ public_path('images/dgp_logo_bg.png') }}") no-repeat center;
            background-size: 400px;
            opacity: 0.98;
            margin: 0;
            padding: 40px;
            color: #1f2937;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 3px solid #facc15;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #065f46;
        }

        .header p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #4b5563;
        }

        .card {
            background-color: rgba(240, 253, 244, 0.85);
            border: 0.1px solid #000;
            border-radius: 10px;
            padding: 20px 30px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            color: #065f46;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 3px solid #facc15;
        }

        .label {
            font-weight: bold;
            color: #065f46;
        }

        p {
            margin: 6px 0;
            font-size: 14px;
        }

        .qr-container {
            text-align: center;
            margin-top: 30px;
        }

        .qr-container svg {
            display: inline-block;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>DIGI Pet Official Report</h1>
        <p>Generated on {{ now()->format('F j, Y') }}</p>
    </div>

    <!-- Pet Details -->
    <div class="card">
        <div class="section-title">Pet Details</div>
        <p><span class="label">Name:</span> {{ $pet->name ?? 'N/A' }}</p>
        <p><span class="label">Type:</span> {{ ucfirst($pet->type ?? 'N/A') }}</p>
        <p><span class="label">Breed:</span> {{ $pet->breed ?? 'N/A' }}</p>
        <p><span class="label">Age:</span> {{ $pet->age ?? 'N/A' }} years</p>
        <p><span class="label">Color:</span> {{ ucfirst($pet->color ?? 'N/A') }}</p>
        <p><span class="label">Birth Date:</span> {{ \Carbon\Carbon::parse($pet->dob ?? now())->format('M j, Y') }}</p>
        <p><span class="label">Microchip Number:</span> {{ $pet->microchip_number ?? 'Not registered' }}</p>
    </div>

    <!-- Owner Details -->
    <div class="card">
        <div class="section-title">Owner Details</div>
        <p><span class="label">Name:</span> {{ $owner->name ?? 'N/A' }}</p>
        <p><span class="label">Email:</span> {{ $owner->email ?? 'N/A' }}</p>
        <p><span class="label">Registered At:</span> {{ \Carbon\Carbon::parse($owner->created_at ?? now())->format('M j, Y') }}</p>
    </div>

    <!-- Vaccination & Booster Details -->
    <div class="card">
        <div class="section-title">Vaccination Records</div>
        @if($vaccinations->count())
            @foreach($vaccinations as $vaccination)
                <div style="margin-bottom: 15px;">
                    <p><span class="label">Vaccine:</span> {{ $vaccination->vaccine->name ?? 'N/A' }}</p>
                    <p><span class="label">Date Administered:</span> {{ $vaccination->date_administered->format('M j, Y') }}</p>
                    <p><span class="label">Total Boosters:</span> {{ $vaccination->total_booster_doses }}</p>
                    <p><span class="label">Booster Gap:</span> {{ $vaccination->booster_gap_days }} days</p>

                    @php $doseList = $boosters[$vaccination->id] ?? collect(); @endphp
                    @if($doseList->count())
                        <p><span class="label">Booster Doses:</span></p>
                        <ul style="margin: 0 0 10px 20px; padding: 0;">
                            @foreach($doseList as $dose)
                                <li>{{ \Carbon\Carbon::parse($dose->given_date)->format('M j, Y') }} 
                                    (Ideal: {{ \Carbon\Carbon::parse($dose->ideal_date)->format('M j, Y') }})
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No booster doses recorded.</p>
                    @endif
                </div>
            @endforeach
        @else
            <p>No vaccination records available.</p>
        @endif
    </div>

    <!-- QR Code -->
    <div class="qr-container">
        {!! $qrCodeSvg !!}
        <p style="margin-top: 8px; font-size: 12px; color: #4b5563;">Scan for Pet Verification</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        Powered by DIGI Pet &copy; {{ date('Y') }}. All rights reserved.
    </div>
</body>
</html>
