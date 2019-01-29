# LOCAL NOTIFICATIONS/WEB NOTIFICATIONS

## PERMISSION

API que necessita de permisos per poder actuar:

```
if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    var notification = new Notification("Hi there!");
  }
else {
Notification.requestPermission(function (permission) {
      // If the user accepts, let's create a notification
      if (permission === "granted") {
        var notification = new Notification("Hi there!");
      }
}  
```

o amb promises:

```
Notification.requestPermission().then(function(result) {
  console.log(result);
});
```

## COMPROVAR SUPORT NAVEGADOR

```Javascript
if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }
```  

## Notification events

Per exemple al fer click a la notificació podem seguir un link.

https://developer.mozilla.org/en-US/docs/Web/API/Notifications_API/Using_the_Notifications_API
