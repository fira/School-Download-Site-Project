/* js/global.js
	File containing the scripts used on the main page
	These scripts mostly handle JQuery-UI widgets and AJAX page loading
*/

/* 	Loads the given HTML resource into a specific div 
	Note that the request is *SYNCHRONOUS* and will block other scripts' execution
	This might actually be useful in certain situations such as the login box
	(it prevents the user from validating the dialog before the form is loaded)	*/
function HTTPLoadDivSync(id, src) {	
	// Start by replacing the div content by a "Loading" (cosmetic, might need to be improved)
	document.getElementById(id).innerHTML = "<div class='loadingtext'>Loading...</div>";
	
	// Issue the HTTP request to fetch the contents
	query = new XMLHttpRequest();
	query.open("GET", src, false);
	query.send();
	
	// Then display the results in the div
	if(query.status == 200) { 
		document.getElementById(id).innerHTML = query.responseText;
	/* In case the server return status is not 200 OK, we display an error
	It might be wise processing the errors, but this should not be needed in normal operation */
	} else { 
		document.getElementById(id).innerHTML = "Sorry, there was an error loading the page. <br />";
	}
}

	/* Handling of the Login Dialog */
function initLoginDialog (){
				/* Creates the JQuery-UI Dialog widget housing the form */
				$("#login-dialog").dialog({
					modal: true,
					width: 500,
					height: 450,
					draggable: false,
					resizable: false,
					buttons: {
						"Cancel": function(){ $(this).dialog("destroy"); }, 
						"Submit": function(){ $("#login-form").submit(); }
					}
				});
				
				// Load the form into the dialog
				HTTPLoadDivSync("login-dialog", "parts/loginform.php");
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
					draggable: false,
					resizable: false,
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

/* After a successful load by AJAX, we have to re-initialize the ajaxForm (since the div contents changed) */
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

/* Bind the form opening to the buttons */
$(function(){	
	$("#login-button").button().click(initLoginDialog);
	$( "#reg-button" ).button().click(initRegDialog);

	$("#logout-button").button().click(function() {
		query = new XMLHttpRequest();
		query.open("GET", "parts/logout.php", false);
		query.send();
		
		/* FIXME We should just reload the contents div instead of the whole page */
		window.location.reload();
	});

	$("#search-form").ajaxForm({
		target: "#searchresults",
		success: function() { 
			$("#resultstable").tablesorter({
				headers: {
					6: { sorter: false }
				}
			}); 
		}
	});
});

