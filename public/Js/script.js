$(document).ready(function(){


        $('button.modifCol').click(function (){
            var id = $(this).data("id");
            $('#id').val(id);
        });


        $('#sumbitColor').click(function (){
            var selectedColor = $("#couleur").children("option:selected").val();
            var selectedRow = $("#id").val();
            $('#modal').modal('toggle');
            
            $.ajax({
                type:"POST",
                data:{color : selectedColor, row : selectedRow},
                url: "updateAjax.php",
                success: function(data){
                    var data = JSON.parse(data);
                     updateTable(data);
                } 
            });
        });
        function updateTable(data){
            var couleur = data[0];
            var ligne = data[1];
            
            $('td:contains("'+ ligne +'")').next().html(couleur);
        }


        $("#updatekb").click(function () {
            console.log("click");
            $.ajax({
                type:"POST",
                url: "callTalend.php",
                success : function(data){
                    console.log(data);
                },
            });
        
         });
  }); 