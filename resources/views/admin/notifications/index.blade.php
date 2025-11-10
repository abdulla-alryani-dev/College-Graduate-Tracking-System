@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>جميع التنبيهات</h1>
        <table class="table">
            <thead>
            <tr>
                <th>الرسالة</th>
                <th>التاريخ</th>
                <th>الحالة</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($notifications as $notification)
                <tr>
                    <td>
                        <a href="{{ route('admin.notifications.show', $notification->id) }}">
                            {{ $notification->data['message'] }}
                        </a>
                    </td>
                    <td>{{ $notification->created_at->diffForHumans() }}</td>
                    <td>{{ $notification->read_at ? 'مقروء' : 'غير مقروء' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $notifications->links() }}
    </div>
@endsection
