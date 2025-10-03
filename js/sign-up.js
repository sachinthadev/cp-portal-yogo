import {fetchPost} from './request.js';
import {loading, notification, pageAlert, stopLoading} from "./util.js";

window.onload = function () {

    //iCheck init
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    //form submition
    $('#signUpForm').submit(async function () {
        // we stoped it
        event.preventDefault();

        //get the text field data
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirmPassword").value;

        //check both are equal
        if (password === confirmPassword){

            //array init
            const data = {
                email: email,
                password: password
            };

            let result = await fetchPost('../service/submit-signup-details.php', data);

            if (result.status === 0) {
                if (result.data.status === 0) {
                    window.location.href = "../index.php";
                } else if (result.data.status === 1) {
                    notification('error', 'ERROR', result.data.message);
                }

            } else {
                notification('error','ERROR','Something went wrong, Please refresh and try again');
                console.error(result.data);
            }
        }else {
            notification('error','ERROR','Password you entered is invalid from confirm password' );
        }
    });
};