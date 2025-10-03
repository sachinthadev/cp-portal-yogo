import { fetchPost } from './request.js';
import { notification } from "./util.js";

window.onload = function () {
    $('#signInForm').off('submit').on('submit', async function (event) {
        event.preventDefault();

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("passwordTxt").value.trim();

        if (!email || !password) {
            notification('error', 'ERROR', 'Email and password are required');
            return;
        }

        const data = { email, password };

        try {
            const result = await fetchPost('../service/submit-sign-in-credentials.php', data);

            if (result.status === 0 && result.data.status === 0) {
                // ✅ Login successful
                const session = result.data.session || {};

                // Show details in a notification
                let details = `
                    Login successful! <br>
                    Email: ${session.email || '-'} <br>
                    Employee Name: ${session.employee_name || '-'}
                    Company Name: ${session.company_name || '-'}
                `;

                notification('success', 'WELCOME', details);

                // Redirect after short delay
                setTimeout(() => {
                    window.location.href = "../index.php";
                }, 1500);

            } else {
                notification('error', 'ERROR', result.data.message || 'Login failed');
            }
        } catch (err) {
            console.error(err);
            notification('error', 'ERROR', 'Something went wrong. Please try again.');
        }
    });
};
