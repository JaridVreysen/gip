function editFiche(id) {
  
    console.log('edit');
    console.log(id);
    

        $.ajax({
        method: 'POST',
        url: './includes/edit-fiche.php',
        data: {
          id
        },
        dataType: 'json', 
        success: function(response) {
          console.log(response);
        },

      });
    
}