
<div class="well wellClass center bg-stripes" id="login">
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
      <input class="form-control btn-primary" type="submit" value="Submit"/>
      <span class="text-danger"><?php echo $this->session->flashdata("error"); ?></span>
  	</form>
  </div>
</div>
<script>
  /*$(document).ready(function(){
    $('#formError').hide();
//--------------------------------------------------------------------
    $('#formId').submit(function(e){
      e.preventDefault();
      var url = $(this).attr('action');
      var postData = $(this).serialize();
      $.post(url, postData, function(o){
        if (o.result == 0) {
          $("#formError").show();
          var output = '<ul>';
          for(var key in o.error){
            var value = o.error[key];
            output += '<li>'+ value + '</li>';
          }
          output += '</ul>';
          $('#formError').html(output);
        }
        if (o.result == false) {
          //Invalid login
        }
        else{
          window.location.href = "<?= site_url('home/app') ?>"
        }
      }, 'json');
    });
  });*/
</script>
