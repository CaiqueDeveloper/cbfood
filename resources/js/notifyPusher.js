

Pusher.logToConsole = true;
var pusher = new Pusher(window.Laravel.pusher.key, {
cluster: window.Laravel.pusher.cluster
});
var channel = pusher.subscribe('new-order');
    channel.bind('App\\Events\\NotifyTheCompanySalesTheRequstUser', function(data) {
        
    if(Notification.permission === 'grated'){
        const notification = new Notification(`Você tem um novo pedido de ${data.order.user[0].name}`,{
            icon: 'https://i.postimg.cc/W3Mhx5s3/Group-1-2.png',
            vibrate: window.navigator.vibrate([200]),
    })
    }else if(Notification.permission !== "denied"){
        Notification.requestPermission().then(permission =>{
            if(permission === "granted"){
                const notification = new Notification(`Você tem um novo pedido de ${data.order.user[0].name}`,{
                icon: 'https://i.postimg.cc/W3Mhx5s3/Group-1-2.png',
                vibrate: window.navigator.vibrate([200]),
            })
            }
        })
    }
});