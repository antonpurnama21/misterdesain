$("body").on("click", ".to-do", function(){
    var clickedItem = $(this);
    var clickedVal = clickedItem.attr('data-value');
    $.ajax({
      url: "root/updateTododata",
      type:"POST",
      data:
      {
      'toid': $(this).attr('data-id'),         
      'tovalue': $(this).attr('data-value'),
      },
      success: function(response) {
          var response = JSON.parse(response);
          if(response.status == 'error') {

            $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);

            } else if(response.status == 'success'){
                console.log(response);

                if(response.value == 1) {
                    clickedItem.attr('data-value', 0);
                } else if(response.value == 0) {
                    clickedItem.attr('data-value', 1);
                }

                $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);

            }
      },
      error: function(response) {
        console.error();
      }
    });
});

$("#add_todo").on("submit", function(event){
    event.preventDefault();
    //console.log( $( this ).serialize() );
    $.ajax({
          url: "root/addTodoData",
          type:"POST",
          data:$( this ).serialize(),
          dataType: "html",
          success: function(response) {
              var response = JSON.parse(response);
              if(response.status == 'error') {

              $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);

              } else if(response.status == 'success'){

                  $(".flashmessage").fadeIn('fast').delay(3000).fadeOut('fast').html(response.message);
                  
                  $(".todo-list").prepend(response.todoHtml);
              }              
          },
          error: function(response) {
          console.error();
          }
      });
  });