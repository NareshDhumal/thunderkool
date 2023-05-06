<footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
             Copyright @2023 JM BAXI
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                <a href="http://parasightsolutions.com/">
                Powered By Parasight Solutions
                </a>
            </div>
          </div>
        </div>
      </footer>
 


   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
   <script src="{{ asset('public/assets/js/jquery.min.js')}}"></script>
   <script src="{{ asset('public/assets/js/paper-dashboard.min.js')}}"></script>
   <script src="{{ asset('public/assets/js/popper.min.js')}}"></script>
   <script src="{{ asset('public/assets/js/bootstrap.min.js')}}"></script>
   <script src="{{ asset('public/assets/js/perfect-scrollbar.jquery.min.js')}}"></script>
   <script src="{{ asset('public/assets/js/chartjs.min.js')}}"></script>
   <script src="{{ asset('public/assets/js/bootstrap-notify.js')}}"></script>
  <script src="{{ asset('public/assets/js/paper-dashboard.js')}}"></script>
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

<script>
  // Add active class to the current button (highlight it)
  var header = document.getElementById("active-div");
  var btns = header.getElementsByClassName("active-class");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    });
  }
  </script>
  
  
  