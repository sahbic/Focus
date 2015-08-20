function initialize() {
  $('#add-new').submit(function () {
      console.log("hey")
    var table = document.getElementById("list");

    var userID = $("#userid").val(),
        itemName = $("#ID").val(),
        itemType = $('input[name="Type"]:checked').val(),
        itemColor = $("#ItemColor").val(),
        itemThickness = $("#Thickness").val(),
        itemFormality = $("#Formality").val(),
        itemLength = $("#Length").val(),
        itemAttractiveness = $("#Attractiveness").val(),
        itemFitness = $("#Fitness").val();

      $.ajax({
          type: "POST",
          url: "db-interaction/items.php",
          data: "action=add&userid=" + userID + "&name=" + itemName + "&type=" + itemType +
          "&color=" + itemColor + "&thickness=" + itemThickness +
          "&formality=" + itemFormality + "&length=" + itemLength +
          "&attractiveness=" + itemAttractiveness + "&fitness=" + itemFitness,
          success: function(theResponse){
            // console.log(theResponse)
            $("#list").append("<tr id="+theResponse+"><td>"+itemName+"</td><td>"+itemType+"</td><td><input type='button' class='btn btn-sm btn-danger' value = 'Delete' id='delete-row'></td></tr>");
            $("#form-content").modal('hide');
          },
          error: function(){
              // uh oh, didn't work. Error message?
          }
      });
    return false ;
  });

  $("#delete-row").live("click", function(){
        var thiscache = $(this);
        // console.log(thiscache.parent().parent().attr('id'))
        var userID = $("#userid").val(),
            itemID = thiscache.parent().parent().attr('id')
      	$.ajax({
  			type: "POST",
  			url: "db-interaction/items.php",
  			data: {
  					"itemid":itemID,
  					"userid":userID,
  					"action":"delete"
  				},
    			success: function(r){
            var index = thiscache.parent().parent()[0].rowIndex;
            var table = document.getElementById("list");
            table.deleteRow(index);
    				},
    			error: function() {
    			    $("#main").prepend("Deleting the item failed...");
    			}
    		});
    });
}
