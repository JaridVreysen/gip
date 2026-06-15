function deleteFiche(id) {
  
    console.log('delete');
    console.log(id);
    

        $.ajax({
        method: 'POST',
        url: './includes/delete-fiche.php',
        data: {
          id
        },
        dataType: 'json', 
        success: function(response) {
          console.log(response);
        },

      });
    
}