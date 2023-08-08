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
