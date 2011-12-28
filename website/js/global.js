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
					height: 400,
					buttons: {
						"Cancel": function(){ $(this).dialog("destroy"); }, 
						"Submit": function(){ $("#login-form").submit(); }
					}
				});
				
				// Load the dialog contents
				HTTPLoadDivSync("login-dialog", "parts/loginform.html");
				// Bind the form to ajaxForm
				initLoginDialogForm();

				return false;
			}



	/* Handling of the Registration Dialog */
function initRegDialog() {
				$( "#reg-dialog" ).dialog({
					modal: true,
					width: 500,
					height: 550,
					buttons: {
						"Cancel": function() {$(this).dialog("destroy");}, 
						"Submit": function() {$("#reg-form").submit();} 
					}
			});			
				
				/* Fetch the new reg page (with error or success displayed) */
				HTTPLoadDivSync("reg-dialog", "parts/regform.php");
				/* Enable ajaxForm on the dialog */
				initRegDialogForm();

				return false;
			}

/* After a successful load by AJAX, we have to re-initialize the ajaxForm (since the div changed) */
function initRegDialogForm() {
	/* Can't be put into initRegDialog, becuase it needs to self-reference. */
	$("#reg-form").ajaxForm({
		target: "#reg-dialog",
		success: initRegDialogForm
	});
}

// Ditto
function initLoginDialogForm () {
	$("#login-form").ajaxForm({
		target: "#login-dialog",
		success: initLoginDialogForm
	});
}

$(function(){	
	$("#login-button").button().click(initLoginDialog);
	$( "#reg-button" ).button().click(initRegDialog);
});

