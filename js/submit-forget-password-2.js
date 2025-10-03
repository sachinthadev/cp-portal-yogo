import { fetchPost } from "./request.js";
import { loading, stopLoading, notify } from "./utils.js";

const form = document.getElementById("forgotStep2Form");

form?.addEventListener("submit", async (e) => {
    e.preventDefault();

    // Correct IDs from Step 2 form
    const email = document.getElementById("step2Email").value.trim();
    const phone_no = document.getElementById("step2Phone").value.trim();
    const otp = document.getElementById("step2Otp").value.trim();
    const new_password = document.getElementById("step2NewPassword").value.trim();
    const confirm_password = document.getElementById("step2ConfirmPassword").value.trim();

    if (!otp || !new_password || !confirm_password) {
        notify("All fields are required", "error");
        return;
    }

    if (new_password !== confirm_password) {
        notify("Passwords do not match", "error");
        return;
    }

    const loader = loading(".forgot-card");

    try {
        const requestBody = { email, phone_no, otp, new_password, confirm_password };

        const result = await fetchPost("../service/submit-forget-password-2.php", requestBody);
        stopLoading(loader);

        if (result.status === 0) {
            notify(result.message || "Password reset successfully", "success");

            setTimeout(() => {
                window.location.href = "../view/sign-in.php";
            }, 1500);

        } else {
            notify(result.message || "Failed to reset password", "error");
        }

    } catch (err) {
        stopLoading(loader);
        notify("Something went wrong. Please try again.", "error");
        console.error(err);
    }
});
