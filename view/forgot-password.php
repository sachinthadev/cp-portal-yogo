<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password | YOGO</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../template/plugins/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f9bd42, #ff914d);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.forgot-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    padding: 35px 30px;
    width: 100%;
    max-width: 420px;
}
.forgot-card h2 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    color: #333;
}
.form-label { 
    font-weight: 500; 
    margin-bottom: 8px; 
    color: #444; 
}
.form-control { 
    border-radius: 12px; 
    height: 48px; 
    padding: 12px 14px; 
    font-size: 15px;
    margin-bottom: 18px;
    border: 1px solid #ddd;
}
.form-control:focus {
    border-color: #f9bd42;
    box-shadow: 0 0 0 3px rgba(249,189,66,0.25);
}
.btn-modern {
    background: #f9bd42; 
    border: none; 
    color: #333;
    font-weight: 600; 
    padding: 14px; 
    border-radius: 12px;
    transition: 0.3s;
    font-size: 15px;
    margin-top: 10px;
}
.btn-modern:hover:not(:disabled) { background: #ffae33; color: #000; }
.btn-modern:disabled { opacity: 0.6; cursor: not-allowed; }

/* Password toggle inside input */
.password-wrapper { 
    position: relative; 
    margin-bottom: 18px;
}
.toggle-password {
    position: absolute;
    top: 50%; 
    right: 14px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 20px;
    color: #888;
    transition: color 0.2s;
}
.toggle-password:hover { color: #333; }
</style>
</head>
<body>
<div class="forgot-card" id="forgotCard">
    <!-- Step 1 form -->
    <div id="step1">
        <h2>Forgot Password</h2>
        <form id="step1Form">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="phoneNo" class="form-label">Phone Number</label>
                <input type="text" id="phoneNo" class="form-control" placeholder="Enter your phone number" required>
            </div>
            <button type="submit" id="nextBtn" class="btn btn-modern w-100">Next</button>
        </form>
    </div>

    <!-- Step 2 form (hidden initially) -->
    <div id="step2" style="display:none;">
        <h2>Verify & Reset</h2>
        <form id="step2Form">
            <input type="hidden" id="step2Email" name="email">
            <input type="hidden" id="step2Phone" name="phone_no">
            <div class="mb-3">
                <label for="otp" class="form-label">OTP</label>
                <input type="text" id="otp" class="form-control" placeholder="Enter OTP" required>
            </div>
            <div class="password-wrapper">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" id="newPassword" class="form-control" placeholder="Enter new password" required>
                <i class="bi bi-eye toggle-password" data-target="newPassword"></i>
            </div>
            <div class="password-wrapper">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" id="confirmPassword" class="form-control" placeholder="Re-enter password" required>
                <i class="bi bi-eye toggle-password" data-target="confirmPassword"></i>
            </div>
            <button type="submit" id="resetBtn" class="btn btn-modern w-100">Reset Password</button>
        </form>
    </div>
</div>

<script type="module" src="../js/utils.js"></script>
<script type="module" src="../js/request.js"></script>
<script type="module">
import { fetchPost } from "../js/request.js";
import { loading, stopLoading, notify } from "../js/utils.js";

// Step 1
const step1Form = document.getElementById("step1Form");
const nextBtn = document.getElementById("nextBtn");
step1Form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.getElementById("email").value.trim();
    const phone_no = document.getElementById("phoneNo").value.trim();

    if (!email || !phone_no) {
        notify("Email and Phone are required", "error");
        return;
    }

    nextBtn.disabled = true;
    const loader = loading(".forgot-card");

    try {
        const result = await fetchPost("../service/submit-forget-password-1.php", { email, phone_no });
        stopLoading(loader);
        nextBtn.disabled = false;

        if (result.status === 0) {
            notify(result.message || "OTP sent successfully", "success");

            document.getElementById("step1").style.display = "none";
            const step2 = document.getElementById("step2");
            step2.style.display = "block";

            document.getElementById("step2Email").value = email;
            document.getElementById("step2Phone").value = phone_no;

            setTimeout(() => document.getElementById("otp").focus(), 200);
        } else {
            notify(result.message || "Failed to send OTP", "error");
        }
    } catch (err) {
        stopLoading(loader);
        nextBtn.disabled = false;
        notify("Something went wrong", "error");
        console.error(err);
    }
});

// Step 2
const step2Form = document.getElementById("step2Form");
const resetBtn = document.getElementById("resetBtn");
step2Form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const email = document.getElementById("step2Email").value.trim();
    const phone_no = document.getElementById("step2Phone").value.trim();
    const otp = document.getElementById("otp").value.trim();
    const new_password = document.getElementById("newPassword").value.trim();
    const confirm_password = document.getElementById("confirmPassword").value.trim();

    if (!otp || !new_password || !confirm_password) {
        notify("All fields are required", "error");
        return;
    }
    if (new_password !== confirm_password) {
        notify("Passwords do not match", "error");
        return;
    }

    resetBtn.disabled = true;
    const loader = loading(".forgot-card");

    try {
        const result = await fetchPost("../service/submit-forget-password-2.php", {
            email, phone_no, otp, new_password, confirm_password
        });
        stopLoading(loader);
        resetBtn.disabled = false;

        if (result.status === 0) {
            notify(result.message || "Password reset successfully", "success");
            setTimeout(() => { window.location.href = "../view/sign-in.php"; }, 1500);
        } else {
            notify(result.message || "Failed to reset password", "error");
        }
    } catch (err) {
        stopLoading(loader);
        resetBtn.disabled = false;
        notify("Something went wrong", "error");
        console.error(err);
    }
});

// Show/Hide password toggle (Bootstrap icons)
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("toggle-password")) {
        const targetId = e.target.getAttribute("data-target");
        const input = document.getElementById(targetId);

        if (input.type === "password") {
            input.type = "text";
            e.target.classList.remove("bi-eye");
            e.target.classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            e.target.classList.remove("bi-eye-slash");
            e.target.classList.add("bi-eye");
        }
    }
});
</script>
</body>
</html>
