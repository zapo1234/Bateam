 $(document).ready(function(){
    $(document).ready(function(){
     // recherche du nom du film ou rélisateur
     $('#search').keyup(function(){
     var search = $('#search').val();

     if(search.length > 0) {
       $.ajax({
	  type: 'POST', // on envoi les donnes
	  url:  '/ajax',// on traite par la fichier
      data : {search:search},
	 success:function(data) { // on traite le fichier recherche apres le retour
     $('#resultats_search').html(data);
     $('#movies_list').css('display','none');
	  }
	
	  });

      }
      });

     
       $('#search').blur(function(){
      $('#movies_list').css('display','block'); // afficher le tableau initial 
      $('#resultats_search').css('display','none');// cacher le tableau de la requete ajax
       });


       // actions clic sur les boutons
       // afficher les 5 fims les plus diffusées
        $('.dir').click(function(){
       $.ajax({
	    type: 'POST', // on envoi les donnes
         url:  '/ajax1',// on traite par la fichier
	    success:function(data) { // on traite le fichier recherche apres le retour
        $('#results').html(data);
        $('#pak').css('display','block');
        $('#results').css('display','block');
        
    
	  }
	
	  });

      });


      // actions clic sur les boutons
       // Top 5 des fimls avec le meilleurs radios
        $('.dic').click(function(){
       $.ajax({
	    type: 'POST', // on envoi les donnes
         url:  '/ajax2',// on traite par la fichier
	    success:function(data) { // on traite le fichier recherche apres le retour
        $('#result').html(data);
        $('#pak').css('display','block');
        $('#result').css('display','block');
        
      }
	
	  });

      });


       // actions clic sur les boutons
       // Top 5 des fimls avec le meilleurs radios
        $('.tir').click(function(){
       $.ajax({
	    type: 'POST', // on envoi les donnes
         url:  '/ajax3',// on traite par la fichier
	    success:function(data) { // on traite le fichier recherche apres le retour
        $('#resul').html(data);
        $('#pak').css('display','block');
        $('#resul').css('display','block');
        
      }
	
	  });

      });


     $('#pak').click(function() {
      $('#results').css('display','none');
      $('#result').css('display','none');
      $('#resul').css('display','none');
      $('#pak').css('display','none');
      
      });

      });