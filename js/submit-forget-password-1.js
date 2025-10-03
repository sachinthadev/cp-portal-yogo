// step1.js
import { fetchPost } from "./request.js";
import { loading, stopLoading, notify } from "./utils.js";

const form = document.getElementById("step1Form");
form?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const phone_no = document.getElementById("phoneNo").value.trim();

    if (!email || !phone_no) {
        notify("Both fields are required", "error");
        return;
    }

    const loader = loading(".forgot-card");
    try {
        const result = await fetchPost("../service/submit-forget-password-1.php", { email, phone_no });
        stopLoading(loader);

        if (result.status === 0) {
            notify(result.message || "OTP sent", "success");
            // Move to Step 2
            setTimeout(() => {
                const formData = new FormData();
                formData.append("step", "2");
                formData.append("email", email);
                formData.append("phone_no", phone_no);

                fetch("forgot-password.php", {
                    method: "POST",
                    body: formData
                }).then(res => res.text())
                  .then(html => document.open("text/html").write(html));
            }, 1000);
        } else {
            notify(result.message || "Failed to send OTP", "error");
        }
    } catch (err) {
        stopLoading(loader);
        notify("Something went wrong", "error");
        console.error(err);
    }
});