<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <h1>Verify OTP</h1>

    <form method="POST" action="{{ route('verify-otp.submit') }}">
        @csrf
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <input type="hidden" name="email" value="{{ $email }}">
        <button type="submit">Verify</button>
    </form>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
</body>