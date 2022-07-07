
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.Laravel.pusher.key,
    cluster: window.Laravel.pusher.cluster,
    forceTLS: true
});

require('./notifyPusher')
