Pusher.logToConsole = true;
var pusher = new Pusher(window.Laravel.pusher.key, {
    cluster: window.Laravel.pusher.cluster
});
var channel = pusher.subscribe('orders');
channel.bind('sendOrderCompany', function(data) {
    Ultils.getNotifyComapy();
    
    if(!("Notification" in window)){

        console.log("Esse navegador não suporta a notifiação no desktop");

    }else if(Notification.permission === "granted"){

        var notification = new Notification(`Você tem um novo pedido de ${data.order.user[0].name}`,{
            icon: 'https://i.postimg.cc/W3Mhx5s3/Group-1-2.png',});

    }else if(Notification.permission !== 'denied' || Notification.permission === "default"){
        Notification.requestPermission().then(function(permission) { 
            if (permission === "granted") {
                var notification = new Notification(`Você tem um novo pedido de ${data.order.user[0].name}`,{
                    icon: 'https://i.postimg.cc/W3Mhx5s3/Group-1-2.png',});
            }
        });
    }
});