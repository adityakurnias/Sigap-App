const CACHE_NAME = 'lapor-desa-v2';
self.addEventListener('install', event => {
    event.waitUntil(caches.open(CACHE_NAME).then(cache => cache.addAll([
        '/',
        '/manifest.json',
        '/logo-192.png',
        '/logo-512.png'
    ])));
});
self.addEventListener('fetch', event => {
    event.respondWith(caches.match(event.request).then(response => response
        || fetch(event.request)));
});
