$(document).ready(function(){
  $.ajax({
    url: 'select.php',
    success: function (response) {
      var arr = JSON.parse(response);
      if (Array.isArray(arr) && arr[0] != '') {
        for (i = 0; i < arr.length; i++) {
          if (arr[i] != '') {
            tmp = arr[i].split(';');
            add(tmp[0], tmp[1]);
          }
        }
      }
    }
    });
})

function new_article() {
  var name = prompt("Write new TO DO");
  if (name) {
    var id = guidGenerator();
    add(id, name);
    $.ajax({ type: "GET", url: "insert.php?" + id + "=" + name });
  }
}

function add(id, name) {
  if (name) {
    $('#ft_list').prepend($('<div class="elem" ' + 'id=' + id + '>' + name + '</div>').click(del));
  }
}

function del(event) {
  if (confirm("Are you sure?")) {
    this.remove();
    name = this.innerHTML;
    id = event.target.id;
    $.ajax({ type: "GET", url: "delete.php?" + id + "=" + name });
  }
}

function guidGenerator() {
    var S4 = function() {
       return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
    };
    return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" +S4() +S4() + S4());
}
