import "bootstrap";

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo";

// import Pusher from "pusher-js";
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     wsHost:
//         import.meta.env.VITE_PUSHER_HOST ??
//         `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
//     enabledTransports: ["ws", "wss"],
// });

// import Echo from "laravel-echo";

// window.Echo = new Echo({
//     broadcaster: "pusher",
//     key: "342d6e4af68ca0a5e108",
//     cluster: "ap1",
//     forceTLS: true,
// });

// var channel = window.Echo.channel("admin-channel");
// channel.listen(".admin-notifications", function (data) {
//     alert(JSON.stringify(data));
// });
