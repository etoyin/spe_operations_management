<div class="overlay text-center">
  <div class="overlayContent">
    <i style="color: #000; " class="close fa">&#x2169;</i>
    <div id="innerContent">
      <div id="level"></div><br/>
      <div id="step"></div>
    </div>
  </div>
</div>

<div class="waitLoader">
  <img class="waitLoaderImg" src="<?=base_url()?>public/images/loading.gif"/>
</div>

<div id="mother" class="row">
  <div class="">
    <div id ="box" class="well wellClass bg-stripes">
      <h4 class="text-center">Salary Progression Evaluator</h4>
      <div id = "formDiv">
        <!--?php echo validation_errors(); ?-->

        <div id="formError" class="alert alert-danger"><!--Dynamic error div--></div>
      	<form class="form-group" id="formId" method="post" action="<?= site_url('Salary_Progression/evaluate') ?>" >
      		<div class="trAppend">
                <div class="sections_div">
        					<label for="appointment">Select a Section<br/></label>
                  
        					<select class="form-control" id="sections" name="sections">
                    <option value="">Select a Section</option>
                    <option value="tepo">TEPO</option>
                    <option value="subeb">SUBEB</option>
                    <option value="local">Local Government</option>
                    <option value="mainstream">Mainstream</option>
                  </select>
                  <span class="error">Please re-enter a correct date!</span><br/>
                </div>
                <div>
        					<label for="appointment">Date of Appointment:<br/></label>
                  
        					<input class="form-control inputDate" id="appointDate" placeholder="yyyy-mm-dd" type="date" min="1979-01-01" max="2007-03-31" name="appointDate" value="">
                  <span class="error">Please re-enter a correct date!</span><br/>
                </div>

                <div>
      					  <label for="levelAppoint">Level at Appointment</label>
                  
                  <select class="form-control inputLevel" id="levelAppoint" name="levelAppoint" value="">
                    <option value="0">Select Level of appointment</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                  </select>
                  <span class="error">Please enter the grade level!</span><br/>
                </div>

                <div>
                  <label for="stepAppoint">Step at Appointment</label>
                  
                  <select class="form-control inputStep input" id="stepAppoint" name="stepAppoint" value="<?php $stepAppoint ?>">
                    <option value="0"> Select Step at appointment </option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="6"> 6 </option>
                    <option value="7"> 7 </option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option class="notForLevel15-17" value="10">10</option>
                    <option class="notForLevel15-17" value="11">11</option>
                    <option class="notForLevel12-17" value="12">12</option>
                    <option class="notForLevel12-17" value="13">13</option>
                    <option class="notForLevel12-17" value="14">14</option>
                    <option class="notForLevel12-17" value="15">15</option>
                  </select>
                  <span class="error">Please enter the step!!!</span><br/>
                </div>

      		</div>

      		<div>
            <label>Promotion/ Advancement</label><br/>
      			<div id="promDiv">
      			</div>
            <br/>
            <div>
                <div class="hideClass"><a class="btn btn-md btn-primary" id="addProm">Add Promotion</a></div>
            </div>
      		</div>
          </br>
          <button class="btn btn-md btn-primary" id="evaluate" type="submit" value="Evaluate"> Evaluate </button>
      	</form>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){

      $(document).ajaxStart(function(){
        $(".waitLoader").css("display", "block");
      });
      $(document).ajaxComplete(function(){
        $(".waitLoader").css("display", "none");
      });
      $("#formError").hide();
      //----------------------------------------------------------------------------------------------------
      $("#formId").submit(function(e){
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
          }else{
            //alert(o.evaluation.level + ' ' + o.evaluation.stepcounter);
            $('div#level').html(o.evaluation.level);
            $('div#step').html(o.evaluation.stepcounter);
            $('.overlay').addClass('active');
            console.log(o);
            //window.location.href = "<?= site_url('home/result') ?>";
          }
        }, 'json');
      });
//----------------------------------------------------------------------------------------------------
      $('.close').on('click', function(){
        $('.overlay').removeClass('active');
      });
      console.log(window.localStorage.getItem('login'));
//----------------------------------------------------------------------------------------------------
    });

</script>
<noscript>
  <h2 class="text-center">Your browser does not support JavaScript!</h2>
  <h3>We recommend you use google chrome or firefox or enable javascript on your browser fpr a better experience. </h3>

</noscript>
