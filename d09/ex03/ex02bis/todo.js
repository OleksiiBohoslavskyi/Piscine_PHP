$(document).ready(function(){
  var arr = document.cookie.split(';');
  if (Array.isArray(arr) && arr[0] != '') {
    for (i = 0; i < arr.length; i++) {
      tmp = arr[i].split('=');
      add(tmp[1]);
    }
  }
})

function new_article() {
  var name = prompt("Write new TO DO");
  if (name) {
    add(name);
  }
}

function add(name) {
  if (name) {
    $('#ft_list').prepend($('<div class="elem">' + name + '</div>').click(del));
    addCookies(name);
  }
}

function del() {
  if (confirm("Are you sure?")) {
   this.remove();
   delCookies(this.innerHTML);
  }
}

function addCookies(name) {
  document.cookie = name + "=" + name + ";";
}

function delCookies(name) {
  document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}
