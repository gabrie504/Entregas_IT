// Instalar el service worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open('my-cache').then((cache) => {
      return cache.addAll([
        // Lista de recursos que deseas precachear
        // Por ejemplo, URLs de imágenes, CSS, JS, etc.
      ]);
    })
  );
});

// Manejar las solicitudes
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});


// En tu archivo sw.js (Service Worker)
self.addEventListener('push', event => {
  const options = {
    body: event.data.text(), // El cuerpo de la notificación
    icon: '/images/icons/icon-512x512.png', // Ruta al ícono de la notificación
  };

  event.waitUntil(
    self.registration.showNotification('Título de la notificación', options)
  );
});
