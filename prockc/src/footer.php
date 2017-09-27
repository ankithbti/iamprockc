
<footer>
<div class="container" align="center">
	<hr>
	<p>Single PROCKC account for<br>youC, weC &amp; soC<br>&copy;prockc.com</p>
</div>
</footer>

<script src="../../resources/js/jquery-3.1.0.min.js"></script>
<script src="../../resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="../../resources/js/script.js"></script>
<script>
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $("#autoClose-alert").fadeOut(10000, function() {
    // Animation complete.
  	});
});

$('.join').click(function() {
    $('.join_popup ').slideToggle();
})
</script>

</body>