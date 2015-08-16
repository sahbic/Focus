var data = JSON.parse(localStorage.getItem('json_data'));
if (data==null) {
  data=[];
}

addToFile = function() {
  var unindexed_array = $("#addClothesForm").serializeArray();
  var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });
    data.push(indexed_array);
    // write to localStorage
    localStorage.setItem('json_data', JSON.stringify(data));
}
