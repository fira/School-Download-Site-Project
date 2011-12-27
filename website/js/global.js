/* Loads the given HTML resource into a specific div */
function HTTPLoadDivSync(id, src) {	
	// Start by replacing the div content by a "Loading"
	document.getElementById(id).innerHTML = "<div class='loadingtext'>Loading...</div>";
	
	// Issue the HTTP request to fetch the contents
	query = new XMLHttpRequest();
	query.open("GET", src, false);
	query.send();
	
	// Then display the results in the div
	if(query.status == 200) { 
		document.getElementById(id).innerHTML = query.responseText;
	} else { 
		document.getElementById(id).innerHTML = "Sorry, there was an error loading the page. <br />";
	}
}


	/* Handling of the Login Dialog */
function initLoginDialog (){
				$("#login-dialog").dialog({
					modal: true,
					width: 500,
					buttons: {
						"Cancel": function(){$(this).dialog("destroy");}, 
						"Submit": function(){$("#login-form").submit();}
					}
				});

				HTTPLoadDivSync("login-dialog", "parts/loginform.html");
				return false;
			}



	/* Handling of the Registration Dialog */
function initRegDialog() {
				$( "#reg-dialog" ).dialog({
					modal: true,
					width: 500,
					buttons: {
						"Cancel": function() {$(this).dialog("destroy");}, 
						"Submit": function() {$("#reg-form").submit();} 
					}
			});			

				HTTPLoadDivSync("reg-dialog", "parts/regform.php");

					$("#reg-form").ajaxForm({target: "#reg-dialog"});

				return false;
			}

$(function(){	
	$("#login-button").button().click(initLoginDialog);
	$( "#reg-button" ).button().click(initRegDialog);
});

