<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تفاصيل المرشد</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 15px; }
        .info { padding: 12px 0; border-bottom: 1px solid #ecf0f1; display: flex; }
        .label { font-weight: bold; width: 160px; color: #34495e; }
        .back-link { display: inline-block; margin-top: 20px; color: #3498db; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h1> تفاصيل المرشد #{{ $guide->id }}</h1>
    <div class="info"><span class="label">الاسم:</span> {{ $guide->name }}</div>
    <div class="info"><span class="label">البريد الإلكتروني:</span> {{ $guide->email }}</div>
    <div class="info"><span class="label">رقم الهاتف:</span> {{ $guide->phone }}</div>
    <div class="info"><span class="label">الحالة:</span> {{ $guide->status == 'active' ? 'نشط' : 'غير نشط' }}</div>
    <a href="{{ route('admin.guides.index') }}" class="back-link">⬅ العودة إلى القائمة</a>
</div>
</body>
</html>
