<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل الحجز</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 15px; }
        .info { padding: 12px 0; border-bottom: 1px solid #ecf0f1; display: flex; }
        .label { font-weight: bold; width: 160px; color: #34495e; }
        .value { color: #2c3e50; }
        .back-link { display: inline-block; margin-top: 20px; color: #3498db; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1>📄 تفاصيل الحجز #{{ $booking->id }}</h1>
    <div class="info"><span class="label">المستخدم:</span> <span class="value">{{ $booking->user->name ?? 'غير معروف' }}</span></div>
    <div class="info"><span class="label">الرحلة:</span> <span class="value">{{ $booking->trip->title ?? 'غير معروف' }}</span></div>
    <div class="info"><span class="label">عدد المقاعد:</span> <span class="value">{{ $booking->number_of_seats }}</span></div>
    <div class="info"><span class="label">السعر الإجمالي:</span> <span class="value">${{ number_format($booking->total_price, 2) }}</span></div>
    <div class="info"><span class="label">أسماء المرافقين:</span> <span class="value">{{ implode(', ', json_decode($booking->guest_names, true) ?? []) }}</span></div>
    <div class="info"><span class="label">حالة الحجز:</span> <span class="value">{{ $booking->status }}</span></div>
    <div class="info"><span class="label">تاريخ الحجز:</span> <span class="value">{{ optional($booking->booking_date)->format('Y-m-d H:i') }}</span></div>

    <a href="{{ route('admin.bookings.index') }}" class="back-link">⬅ العودة إلى القائمة</a>
</div>
</body>
</html>
