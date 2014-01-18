
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
function addWine(id){
	
	var i2 = "countWine" + id;
	var i3 = document.getElementById(i2).value;

	$.ajax({
		type : 'post',
		url : 'includes/crudMyWine.php',
		data : {
			number:i3, wineID:id
		},

		success : function(msg) {
			if (msg!=null) {
				var i2 = "countWine" + id;
				var i3 = document.getElementById(i2).value;
				alert(i3 + "Stück ihren Weinkeller hinzugfügt ");

			}else{
				
				alert("Bitte zuerst einloggen ");

			}

		}

	});
	
}

function searchWine() {

	var searchDish = document.getElementById("searchTermValue").value;
	var searchCountry = getCountry();
	var searchWineType = getWineType(); 
		
	if(searchDish == ''){
	$.ajax({
		type : 'POST',
		url : 'includes/getWine.php',
		data : {searchCountry:searchCountry, searchWineType:searchWineType},
		success : function(result) {
			
			document.getElementById("resultList").innerHTML = result;

		},
		error : function(err, result) {
			alert("Error in delete" + err.responseText);
		}
	});
	}else{
		$.ajax({
			type : 'POST',
			url : 'includes/getWine.php',
			data : {searchDish:searchDish, searchCountry:searchCountry, searchWineType:searchWineType},
			success : function(result) {
				
				document.getElementById("resultList").innerHTML = result;

			},
			error : function(err, result) {
				alert("Error in delete" + err.responseText);
			}
		});
	}
}

function popup_wait(action){
	
	
	var w=500;
	var h=100;
	var toscroll = 'yes';
	var resize = 'no';
	var LeftPosition = (screen.width) ? (screen.width-w)/2 : 0; 
	var TopPosition = (screen.height) ? (screen.height-h)/2 : 0; 

	alert(message)
	
}
function searchMyWine() {

	var searchDish = document.getElementById("searchTermValue").value;
	var searchCountry = getCountry();
	var searchWineType = getWineType(); 
	
	if(searchDish == ''){
	$.ajax({
		type : 'POST',
		url : 'includes/getWine.php',
		data : {searchCountry:searchCountry, searchWineType:searchWineType},
		success : function(result) {
			
			document.getElementById("resultList").innerHTML = result;

		},
		error : function(err, result) {
			alert("Error in delete" + err.responseText);
		}
	});
	}else{
		$.ajax({
			type : 'POST',
			url : 'includes/getWine.php',
			data : {searchDish:searchDish, searchCountry:searchCountry, searchWineType:searchWineType},
			success : function(result) {
				
				document.getElementById("resultList").innerHTML = result;

			},
			error : function(err, result) {
				alert("Error in delete" + err.responseText);
			}
		});
	}
}

//function getSearchDish(){
//	
//	var dish;
//	$("input:checkbox[name=country]:checked").each(function() {
//		country.push($(this).val());
//	});
//	var searchCountry = JSON.stringify(country);

//	var searchCountry = {
//		searchCountry : searchCountry
//	};
	
//	return searchCountry;

function getCountry(){
	
	var country = new Array();
	$("input:checkbox[name=country]:checked").each(function() {
		country.push($(this).val());
	});
	var searchCountry = JSON.stringify(country);

//	var searchCountry = {
//		searchCountry : searchCountry
//	};
	
	return searchCountry;
	
}
function getWineType(){
	
	var vineType = new Array();
	$("input:checkbox[name=wineType]:checked").each(function() {
		vineType.push($(this).val());
	});
	var searchWineType = JSON.stringify(vineType);

//	var searchWineType = {
//		searchWineType : searchWineType
//	};
	
	return searchWineType;
	
}
function searchWineFirstLoad(){

	if(document.getElementById("resultList").innerHTML == ""){
		searchWine();
	}
}
function searchMyWineFirstLoad(){

	if(document.getElementById("resultList").innerHTML == ""){
		searchMyWine();
	}
}

function dishSuggestion(){
	$('#searchTermValue').keyup(function() {
		alert( "Handler for .keyup() called." );

//	  var val = $.trim( this.value );
//	  if(val.length == 3) {
//	    
//	    var finalStr = "system"+encodeURIComponent("|^")+"0"+encodeURIComponent("|^")+ val;
//	  }
	});
}
