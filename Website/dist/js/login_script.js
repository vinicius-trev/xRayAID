/*!
 * xRayAID
 * js/login_script.js
 * Copyright 2020 xRayAID.com.br
 * Created by: Vinicius Trevisan
 */

/* Create the Variables */
var btn_login = document.getElementById("login");   /* Get Login div element */
var span_login = document.getElementsByClassName("close-login")[0]; /* Get the close login div, used to close the popup */
var iframe_div = document.getElementById("login-responsive");   /* Get the ID of the iframe, to manipulate it */

/* Functions */
btn_login.onclick = function ()    /* When click on login button, execute this script */
{
    /* If the window size is bigger than 992px exibt the iframe */
    if (window.matchMedia("(min-width: 992px)").matches) 
    {
        /* If the window is big, insert the iframe on index */
        iframe_div.innerHTML = '<div id="login-frame" class="modal"> \
                                    <div class="modal-content scroll-auto align-items-center" id> \
                                        <iframe src="login.php" class="login" id="login-iframe" frameborder="0"></iframe> \
                                        <span class="close-login">&times;</span> \
                                    </div> \
                                </div>';

        /* And executes effect to make the iframe fade in */
        $("#login-frame").fadeIn('slow');

        /* Then, with the iframe created, create the variables that represent its div's */
        login = document.getElementById("login-frame");
        span_login = document.getElementsByClassName("close-login")[0];

        /* Here, we are declaring the close function when X is presses on the iframe div */
        login.style.display = "block";
        span_login.onclick = function () 
        {
            /* Make the iframe invisible */
            document.getElementById("login-frame").style.display = "none";
        }
    } 
    else 
    {
        /* If the window size is <= 992px, redirect to login php page */
        window.location.href = "./login.php";
    }
}