$(document).ready(function(){
//	alert("why y'all!!!!!");
	//var promDiv = $('#promDiv');
	var i = $('#promDiv').size();

	var divAlert = '<div class="alert alert-danger">';
	var closeDiv = '</div>';

	var phpErrorDate = '<?php echo form_error("datePromotion[]", divAlert , closeDiv);?>';
	var phpErrorLevel = '<?php echo form_error("levelProm[]", divAlert , closeDiv);?>';

	$('#addProm').live('click', function(){
		$("#promDiv").append('<div class="append"><div><label>Date of Promotion/ Advancement:</label>'+phpErrorDate+'<input class="form-control inputDate" id="datePromotion" type="date" min="1979-01-01" max="2007-03-31" name="datePromotion[]" value=""/></div><div><label>Level of Promotion.</label>'+phpErrorLevel+'<select class="form-control inputLevel" id="levelProm" name="levelProm[]"><option value="0">Select Level</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option></select></div><br/><div><a class="btn btn-primary btn-sm" id="remInput">Remove</a></div></div>');
		i++;

		return false;
	});
	$("#remInput").live('click', function(){
	  if(i > 1){
	    $(this).parents('div.append').remove();
	            //i--;
	            //console.log(i);
	   }
	  return false;
	});




	$("#stepAppoint").children().hide();
	function changeFunc(){
		var levelAppoint = document.getElementById("levelAppoint").value;
		if (levelAppoint >= 15 && levelAppoint <= 17) {
			//$("#stepAppoint").children().show();
			$("#stepAppoint").children().show();
			$("#stepAppoint").children(".notForLevel12-17").hide();
			$("#stepAppoint").children(".notForLevel15-17").hide();
		}else if (levelAppoint >=12 && levelAppoint <=14) {
			//$("#stepAppoint").children().show();
			$("#stepAppoint").children().show();
			$("#stepAppoint").children(".notForLevel12-17").hide();
			$("#stepAppoint").children(".notForLevel15-17").show();
		}else {
			$("#stepAppoint").children().show();
		}
	}

	$("#levelAppoint").on('change', changeFunc);
/*


	$(".inputDate").on('input', function(){
		var dateInput = $(this).val();
		var re = /((1[9]|2[0])\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
		if(re.test(dateInput)){
			//alert('Yes');
			$(this).removeClass('invalid').addClass('valid');
		}else if(dateInput==null){
			alert('NO');
			$(this).removeClass('valid').addClass('invalid');
		} else{
			//alert("invalid");
			$(this).removeClass('valid').addClass('invalid');
		}
	});

	$(".inputLevel").on('input', function(){
		var levelInput = $(this).val();
		if(levelInput < 1){
			$(this).removeClass('valid').addClass('invalid');
		}else{
			$(this).removeClass('invalid').addClass('valid');
		}
	});

	$(".inputStep").on('input', function(){
		var stepInput = $(this).val();
		if(stepInput < 1){
			$(this).removeClass('valid').addClass('invalid');
		}else{
			$(this).removeClass('invalid').addClass('valid');
		}
	});
	$("button#evaluate").click(function(event){
		//alert('yes');
		var formData = $("#formId").serializeArray();
		var errorFree = true;
		for (var input in formData){
			var element = $("#"+formData[input]['name']);
			var valid = element.hasClass("valid");
			var errorElement = $("span", element.parent());
			if (!valid) {
				errorElement.removeClass("error").addClass("error_show");
				errorFree = false;
			} else {
				errorElement.removeClass("error_show").addClass("error");
			}
		}
		if (!errorFree){
			event.preventDefault();
			console.log(formData);

		}else{
			//alert(formData);
			alert('No errors: Form will be submitted');
		}
	});*/

});
