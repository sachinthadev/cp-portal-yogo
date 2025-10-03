import { fetchPost } from './request.js';
import {
    loading,
    stopLoading,
    notification,
} from "./util.js";

window.onload = function () {
    getCreditDetails();
};

const getCreditDetails = async () => {
    const load = loading("#mainPanel");
    const data = {};
    try {
        let result = await fetchPost('../service/get-credit-details.php', data);
        stopLoading(load);

        if (result.status === 0) {
            if (result.data.status === 0) {
                const creditDetails = result.data.data;
                if (creditDetails) {
                    document.getElementById("creditLimit").innerText = `Credit Limit: Rs ${creditDetails.credit_limit}`;
                    document.getElementById("creditBalance").innerText = `Credit Balance: Rs ${creditDetails.credit_balance}`;
                } else {
                    console.warn("Credit details missing in response");
                    document.getElementById("creditLimit").innerText = "Credit Limit: N/A";
                    document.getElementById("creditBalance").innerText = "Credit Balance: N/A";
                }
            } else if (result.data.status === 1) {
                window.location.href = "../view/440.php";
            } else if (result.data.status === 2) {
                notification('error', 'ERROR', result.data.message);
            }
        } else {
            notification('error', 'ERROR', 'Something went wrong, please refresh and try again');
            console.error(result.data);
        }
    } catch (err) {
        stopLoading(load);
        console.error("Credit API Error:", err);
        notification('error', 'ERROR', 'Request failed, please try again later.');
    }
};