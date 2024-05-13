@php
    $messageType = session('success') ? 'success' : (session('fail') ? 'error' : '');
    $message = session('success') ?? (session('fail') ?? '');
@endphp

@if ($message)
    <div id="notification"
        class="fixed top-24 right-5 py-2 px-4 rounded-xl shadow-lg text-white {{ $messageType == 'success' ? 'bg-green-500' : 'bg-red-500' }}">
        {{ $message }}
    </div>

    <script>
        // Make the notification disappear after 3 seconds
        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500); // Wait an extra 500ms for the opacity transition
            }
        }, 3000);
    </script>
@endif
