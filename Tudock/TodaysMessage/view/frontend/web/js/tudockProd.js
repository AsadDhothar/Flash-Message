require([
    "jquery"
], function($){
    $(document).ready(function() {
        setTimeout(() => {
            document.getElementById("msgediv").style.display = "none";
        }, 5000);
    });
});