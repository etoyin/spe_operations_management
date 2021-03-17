		</div>
		<!-- end:wrapper-->

		<footer class="">
			<div class="text-center">
				&copy; <?php echo date('Y')?>
				<h4>Powered by</h4>
				<a href="https://etoyin.github.io">
					<img height="30px" src="<?=base_url()?>public/images/etoyin-footer.png"/>
				</a>
			</div>
		</footer>

		<script>
    // Script to open and close sidebar
      function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
      }
      
      function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
      }

      // Modal Image Gallery
      function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
      }
			
    </script>

	</body>
</html>
