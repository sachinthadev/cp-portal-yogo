

// Loader
export function loading(selector) {
    const container = document.querySelector(selector);
    if (!container) return null;

    const overlay = document.createElement("div");
    overlay.className = "loading-overlay d-flex justify-content-center align-items-center";
    overlay.innerHTML = `
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    `;
    Object.assign(overlay.style, {
        position: "absolute",
        top: 0, left: 0, width: "100%", height: "100%",
        background: "rgba(255,255,255,0.7)",
        zIndex: 9999, borderRadius: "inherit"
    });

    container.appendChild(overlay);
    return overlay;
}

export function stopLoading(overlay) {
    if (overlay && overlay.parentNode) overlay.remove();
}

// Notification
export function notify(message, type = "success") {
    let notif = document.getElementById("simpleNotification");
    if (!notif) {
        notif = document.createElement("div");
        notif.id = "simpleNotification";
        notif.style.position = "fixed";
        notif.style.top = "20px";
        notif.style.right = "20px";
        notif.style.padding = "15px";
        notif.style.borderRadius = "5px";
        notif.style.fontWeight = "bold";
        notif.style.color = "#fff";
        notif.style.zIndex = "9999";
        document.body.appendChild(notif);
    }
    notif.style.backgroundColor = type === "success" ? "#4CAF50" : "#f44336";
    notif.textContent = message;
    notif.style.display = "block";
    setTimeout(() => { notif.style.display = "none"; }, 3000);
}
