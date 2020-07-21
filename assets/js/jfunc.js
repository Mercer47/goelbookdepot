$(".form").submit(function(e) {
	var form_data=$(this).serialize();
$.ajax({ //make ajax request to cart_process.php
        url: "cart.php",
        type: "POST",
      
        data: form_data
    })
alert("Added");

	 e.preventDefault();
});


		$( ".form2" ).submit(function( event) {
 
    // If .required's value's length is zero
    if ( $( "#required" ).val().length === 0 ) {
 
      alert("A field was left empty");
        event.preventDefault();
    } 
});