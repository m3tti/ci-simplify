if (navigator.serviceWorker) {
    this.addEventListener("load", async function() {
        let container = navigator.serviceWorker;
        if (!container.controller) {
            console.log("Try to register new sw");
            await container.register(base_url + "/js/sw.js");
            console.log("SW installed");
            
        } else {
            console.log("SW already registered");
        }
    });
}