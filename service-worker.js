// Definir una versión del caché
const cacheVersion = 'v1';

// Archivos que deseas almacenar en caché
const cacheFiles = [
  '/',
  '/css/app.css',
  '/js/app.js',
  // Agrega aquí otros archivos que deseas cachear
];

// Evento 'install' del Service Worker
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(cacheVersion)
      .then(cache => cache.addAll(cacheFiles))
  );
});

// Evento 'fetch' del Service Worker
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});
