
<div class="well wellClass bg-stripes" id="login">
  <h2 class="text-center"> Login </h2>
  <div id = "formDiv" class="text-center">
    <!--div id="formError" class="alert alert-danger"><Dynamic error div></div-->
  	<form class="form-group" id="formId" method="post" action="<?= site_url('Login/login') ?>">
      <input class="form-control" name="username" type="text" placeholder="User Name" required/>
      <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
      <br/>
      <input class="form-control" name="password" type="password" placeholder="Password" required/>
      <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
      <br/>
      <input class="form-control login btn-primary" type="submit" value="Submit"/>
      <span class="text-danger" id='login-err'></span>
  	</form>
  </div>
</div>

<script>
  function pageRedirect() {
    window.location.href = "Home";
  };
  $(document).ready(function(){
    $("#formId").submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      var postData = $(this).serialize();
      $.post(url, postData, function(o){
        if (o.result == 0) {
          $('#login-err').text('Username or Password incorrect');
          console.log(o);
        }else{
          $('#login-err').text('');
          localStorage.setItem('login', 'success');
          console.log(o);
          pageRedirect();
          //window.location.href = "<?= site_url('home/result') ?>";
        }
      }, 'json');
    });
  })
</script>