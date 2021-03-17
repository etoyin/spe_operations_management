
<div class="well wellClass bg-stripes" id="login">
  <h2 class="text-center"> Login </h2>
  <div id = "formDiv" class="text-center">
    <!--div id="formError" class="alert alert-danger"><Dynamic error div></div-->
  	<form class="form-group" id="formId" method="post" action="<?= site_url('Login/login') ?>">
      <input class="form-control" name="username" type="text" placeholder="User Name"/>
      <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
      <br/>
      <input class="form-control" name="password" type="password" placeholder="Password"/>
      <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
      <br/>
      <input class="form-control login btn-primary" type="submit" value="Submit"/>
      <span class="text-danger"><?php echo $this->session->flashdata("error"); ?></span>
  	</form>
  </div>
</div>