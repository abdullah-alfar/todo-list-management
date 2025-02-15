import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.connector.pusher.connection.bind('connected', () => {
    console.log('WebSocket connected');
});

// Get the authenticated user's ID (passed from the backend)
const userId = window.userId;
console.log('userId',userId)
// Subscribe to the private channel
// window.Echo.private(`notifications.${userId}`)
//     .listen('PrivateNotification', (data) => {
//         console.log('Notification received:', data.message);

//         // Display the notification to the user
//         alert(`New Notification: ${data.message}`);
// });


window.Echo.private(`notifications.${userId}`)
    .subscribed(() => {
        console.log(`Successfully subscribed to notifications.${userId}`);
    })
    .error((error) => {
        console.error('Subscription error:', error);
    })
    .listen('PrivateNotification', (data) => {
        console.log('Notification received:', data.message);
    });
