<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الحجوزات</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f8f9fc; padding: 20px; }
        .container { max-width: 1300px; margin: auto; background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 2px 15px rgba(0,0,0,0.08); }
        h1 { color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 15px; }
        .filters { display: flex; flex-wrap: wrap; gap: 12px; background: #f1f5f9; padding: 20px; border-radius: 10px; margin-bottom: 25px; align-items: center; }
        .filters select, .filters input { padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 8px; background: white; min-width: 130px; }
        .btn { padding: 8px 16px; border-radius: 8px; border: none; cursor: pointer; text-decoration: none; color: white; font-weight: bold; transition: 0.3s; }
        .btn-primary { background: #3498db; }
        .btn-primary:hover { background: #2980b9; }
        .btn-warning { background: #f39c12; }
        .btn-warning:hover { background: #d68910; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm { padding: 5px 10px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #2c3e50; color: white; padding: 12px; text-align: center; }
        td { padding: 12px; text-align: center; border-bottom: 1px solid #ecf0f1; }
        tr:hover { background: #f8f9fa; }
        .badge { padding: 5px 12px; border-radius: 20px; color: white; font-size: 13px; font-weight: bold; }
        .badge-pending { background: #f39c12; }
        .badge-confirmed { background: #27ae60; }
        .badge-cancelled { background: #e74c3c; }
        .actions form { display: inline-block; margin: 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>📋 إدارة الحجوزات</h1>

    {{-- فلترة الحجوزات --}}
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="filters">
        <select name="status">
            <option value="">كل الحالات</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
        </select>

        <select name="trip_id">
            <option value="">كل الرحلات</option>
            @foreach($trips as $trip)
                <option value="{{ $trip->id }}" {{ request('trip_id') == $trip->id ? 'selected' : '' }}>{{ $trip->title }}</option>
            @endforeach
        </select>

        <select name="user_id">
            <option value="">كل المستخدمين</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>

        <input type="date" name="booking_date" value="{{ request('booking_date') }}" placeholder="تاريخ الحجز">
        <input type="date" name="start_date" value="{{ request('start_date') }}" placeholder="تاريخ الانطلاق">

        <button type="submit" class="btn btn-primary">فلترة</button>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-warning">إلغاء الفلترة</a>
    </form>

    {{-- جدول الحجوزات --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>المستخدم</th>
                <th>الرحلة</th>
                <th>عدد المقاعد</th>
                <th>السعر الإجمالي</th>
                <th>الحالة</th>
                <th>تاريخ الحجز</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name ?? 'غير معروف' }}</td>
                    <td>{{ $booking->trip->title ?? 'غير معروف' }}</td>
                    <td>{{ $booking->number_of_seats }}</td>
                    <td>${{ number_format($booking->total_price, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $booking->status }}">
                            {{ $booking->status == 'pending' ? 'قيد الانتظار' : ($booking->status == 'confirmed' ? 'مؤكد' : 'ملغي') }}
                        </span>
                    </td>
                    <td>{{ optional($booking->booking_date)->format('Y-m-d') ?? 'غير محدد' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-primary btn-sm">عرض</a>
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="padding: 40px; color: #95a5a6;">لا توجد حجوزات لعرضها حالياً</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
