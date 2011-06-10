$(document).ready(function(){

		$("#contactLink").click(function(){
			if ($("#contactForm").is(":hidden")){
				$("#contactForm").slideDown("slow");
			}
			else{
				$("#contactForm").slideUp("slow");
			}
		});
		
		$("#contactLink2").click(function(){
			if ($("#contactForm2").is(":hidden")){
				$("#contactForm2").slideDown("slow");
			}
			else{
				$("#contactForm2").slideUp("slow");
			}
		});
		
	});
	
	function closeForm(){
		$("#messageSent").show("slow");
		setTimeout('$("#messageSent").hide();$("#contactForm").slideD("slow");$("#contactLink").slideUp("slow");', 1000);
   }