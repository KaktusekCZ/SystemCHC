$(document).ready(function(){var o;$(".admin__logout").on("click",function(t){t.preventDefault(),o&&o.abort(),o=$.ajax({url:"logout/logout.php",type:"post"}),o.done(function(o,t,n){1==o&&(window.location.href="login/?status=logout")}),o.fail(function(o,t,n){})})});