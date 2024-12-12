function onActivate(ev) {
    console.log("Send claim");
    ev.waitUntil(this.clients.claim);
}
  
function onFetch(ev) {
    ev.respondWith(fetch(ev.request));
}
  
function onInstall(ev) {
    console.log("Install");
}
  
this.addEventListener("activate", onActivate);
this.addEventListener("fetch", onFetch);
this.addEventListener("install", onInstall);