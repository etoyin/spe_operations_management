

<!-- Header -->
<div class="w3-container" style="margin-top:80px" id="showcase">
  <h1 class="w3-jumbo"><b>Operations Management App</b></h1>
  <h1 class="w3-xxxlarge w3-text-red"><b>Modules</b></h1>
  <hr style="width:50px;border:5px solid red" class="w3-round">
</div>

<!-- Photo grid (modal) -->
<div class="w3-row-padding">
  <div class="w3-half salary_progression modules">
    <h4 style="font-weight: bold">Salary Progression Evaluator</h4>
    <img src="<?=base_url()?>public/images/spe3.png" style="width:100%" alt="Salary Progression Logo">
  </div>

</div>
<br/>

<script>
  function pageRedirectToApp() {
    window.location.href = "Salary_Progression";
  };
  $(document).ready(function(){
    console.log(localStorage.getItem('login'));
    $('.salary_progression').on('click', function(){
      //alert('gggg');
      pageRedirectToApp();
    })
  })
</script>
      