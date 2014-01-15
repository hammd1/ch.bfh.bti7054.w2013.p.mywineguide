function languageSwitch(language) {

	$.ajax({
		type : 'post',
		url : 'includes/languageSwitch.php',
		data : {
			lang:language
		},

		success : function(msg) {
			if (msg == "changed") {
				location.reload();

			}

		}

	});

}
function showSelectionOption(buttonID) {

	var temp = document.getElementsByName(buttonID)[0];
	if (temp.style.display == 'block') {
		temp.style.display = 'none';
	} else {
		temp.style.display = 'block';
	}
}

function searchWine() {

	var country = new Array();
	$("input:checkbox[name=country]:checked").each(function() {
		country.push($(this).val());

	});

	var searchCountry = JSON.stringify(country);

	var searchCountry = {
		searchCountry : searchCountry
	};

	$.ajax({
		type : 'POST',
		url : 'includes/getWine.php',
		data : searchCountry,
		success : function(result) {
			
			document.getElementById("resultList").innerHTML = result;

		},
		error : function(err, result) {
			alert("Error in delete" + err.responseText);
		}
	});
}

function searchWineFirstLoad(){

	if(document.getElementById("resultList").innerHTML == ""){
		searchWine();
	}
}
