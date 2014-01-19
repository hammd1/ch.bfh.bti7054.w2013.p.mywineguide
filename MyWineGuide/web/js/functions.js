/*
 * function switches the language
 * 
 * @param the language to set
 * 
 */
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
/*
 * function shows the selected optionpanel
 * 
 * @param the buttonID to the object
 * 
 * */
function showSelectionOption(buttonID) {

	var temp = document.getElementsByName(buttonID)[0];
	if (temp.style.display == 'block') {
		temp.style.display = 'none';
	} else {
		temp.style.display = 'block';
	}
}

/*
 * function makes ajax-call to add wine into the wineguide-DB
 * triggered from wineSearch.php
 * 
 * @param the id of the wine
 * 
 * */
function addWine(id){
	
	var method = "add";
	var i2 = "countWine" + id;
	var i3 = document.getElementById(i2).value;

	$.ajax({
		type : 'post',
		url : 'includes/myWine.php',
		data : {
			method:method, number:i3, wineID:id
		},

		success : function(msg) {
			
			alert(unescape(msg));


		}

	});
	
}
/*
 * function makes ajax-call to add wine into the wineguide-DB
 * triggered from myWineCellar.php
 * 
 * @param the id of the wine
 * 
 * */
function addMyWine(id){
	
	var method = "add";
	var i2 = "countWine" + id;
	var i3 = document.getElementById(i2).value;

	$.ajax({
		type : 'post',
		url : 'includes/myWine.php',
		data : {
			method:method, number:i3, wineID:id
		},

		success : function(msg) {
			
			searchMyWine();
			alert(unescape(msg));


		}

	});
	
}
/*
 * function makes ajax-call to remove wine from the wineguide-DB
 * triggered from myWineCellar.php
 * 
 * @param the id of the wine
 * 
 * */
function removeWine(id){
	
	var method = "remove";
	var i2 = "countWine" + id;
	var i3 = document.getElementById(i2).value;

	$.ajax({
		type : 'post',
		url : 'includes/myWine.php',
		data : {
			method:method, number:i3, wineID:id
		},

		success : function(msg) {
			searchMyWine();
			alert(unescape(msg));


		}

	});
	
}
/*
 * function  makes ajax-call to search wine from DB
 * 
 * "@return" fills innerElement from resultList in wineSearch
 * 
 * */
function searchWine() {

	var searchDish = document.getElementById("searchTermValue").value;
	var searchCountry = getCountry();
	var searchWineType = getWineType(); 
	var method = "select";
	
	if(searchDish == ''){
	$.ajax({
		type : 'POST',
		url : 'includes/wine.php',
		data : {method:method, searchCountry:searchCountry, searchWineType:searchWineType},
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
			url : 'includes/wine.php',
			data : {method:method, searchDish:searchDish, searchCountry:searchCountry, searchWineType:searchWineType},
			success : function(result) {
				
				document.getElementById("resultList").innerHTML = result;

			},
			error : function(err, result) {
				alert("Error in delete" + err.responseText);
			}
		});
	}
}

//TODO: Implementation of "wait-popup"
function popup_wait(action){
	
	
	var w=500;
	var h=100;
	var toscroll = 'yes';
	var resize = 'no';
	var LeftPosition = (screen.width) ? (screen.width-w)/2 : 0; 
	var TopPosition = (screen.height) ? (screen.height-h)/2 : 0; 

	alert(message)
	
}
/*
 * function  makes ajax-call to search wine from DB where user is logged in
 * 
 * "@return" fills innerElement from resultList in myWineCellar
 * 
 * */
function searchMyWine() {

	var searchDish = document.getElementById("searchTermValue").value;
	var searchCountry = getCountry();
	var searchWineType = getWineType(); 
	var method = "select";

	
	if(searchDish == ''){
	$.ajax({
		type : 'POST',
		url : 'includes/myWine.php',
		data : {method:method, searchCountry:searchCountry, searchWineType:searchWineType},
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
			url : 'includes/myWine.php',
			data : {method:method, searchDish:searchDish, searchCountry:searchCountry, searchWineType:searchWineType},
			success : function(result) {
				
				document.getElementById("resultList").innerHTML = result;

			},
			error : function(err, result) {
				alert("Error in delete" + err.responseText);
			}
		});
	}
}

/*
 * function creates jason-object (array) from all checked checkboxes in category country
 * 
 * "@return" the creates jason object
 * 
 * */
function getCountry(){
	
	var country = new Array();
	$("input:checkbox[name=country]:checked").each(function() {
		country.push($(this).val());
	});
	var searchCountry = JSON.stringify(country);

	return searchCountry;
	
}
/*
 * function creates jason-object (array) from all checked checkboxes in category wineType
 * 
 * "@return" the creates jason object
 * 
 * */
function getWineType(){
	
	var vineType = new Array();
	$("input:checkbox[name=wineType]:checked").each(function() {
		vineType.push($(this).val());
	});
	var searchWineType = JSON.stringify(vineType);
	
	return searchWineType;
	
}

/*
 * if wineSearch is loaded first, get initial wine (top 3 rated)
 * 
 * */
function searchWineFirstLoad(){

	if(document.getElementById("resultList").innerHTML == ""){
		searchWine();
	}
}
/*
 * if myWineCellar is loaded first, get initial wine (top 3 oldest)
 * 
 * */
function searchMyWineFirstLoad(){

	if(document.getElementById("resultList").innerHTML == ""){
		searchMyWine();
	}
}
//TODO: implement keyup function
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
