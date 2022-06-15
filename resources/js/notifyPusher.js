

Pusher.logToConsole = true;
var pusher = new Pusher(window.Laravel.pusher.key, {
    cluster: window.Laravel.pusher.cluster
});
navigator.serviceWorker.register('./sw.js');
var channel = pusher.subscribe('new-order');
    channel.bind('App\\Events\\NotifyTheCompanySalesTheRequstUser', function(data) {
    Notification.requestPermission(function(result) {
        if (result === 'granted') {
            navigator.serviceWorker.ready.then(function(registration) {
                registration.showNotification(`Você tem um novo pedido de ${data.order.user[0].name}`, {
                    icon: 'https://i.postimg.cc/W3Mhx5s3/Group-1-2.png',
                    vibrate: [200, 100, 200, 100, 200, 100, 200],
                });
            });
        }
    });
    Ultils.getNotifyComapy();  
});
