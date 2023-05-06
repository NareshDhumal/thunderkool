<footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
            <span class="copyright">
                © 2023 JMBAXI
              </span>
            </nav>
            <div class="credits ml-auto">

              <p>Powered By Parasight Solutions</p>
            </div>
          </div>
        </div>
      </footer>



<script src="https://code.jquery.com/jquery-3.6.2.min.js"
    integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/paper-dashboard.min.js') }}"></script>
<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/chartjs.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('public/assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/assets/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/assets/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.dataTables.js') }}"></script>





<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
{{--

<script>
  $(document).ready(function() {
$('.nav-item').click(function() {
$('.nav-item').removeClass("active");
$(this).addClass("active");
$(".active").css("background-color:#000000");
});
});
</script> --}}

<script>
  var header = document.getElementByClassName("nav");
var btns = header.getElementsByClassName("nav-link");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  document.getElementByClassName("active").style.background = "yellow";
  });
}
</script>

