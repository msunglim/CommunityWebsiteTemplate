function gotoWrite(){
  //pass current category to write page. so that new post can be posted on appropriate category.
  var s = window.location.toString();
  var newUrl = s.substring(s.indexOf("?id=")+4, s.indexOf("&post_"));
  window.location = "http://localhost/write.php?id="+newUrl+"&type=write";

}
function gotoEdit(){
  //pass current category to write page. so that new post can be posted on appropriate category.
  var s = window.location.toString();

  var newUrl = s.substring(s.indexOf("?id="), s.indexOf("&post_id="));
  var newUrl2 = s.substring(s.indexOf("&post_id="), s.indexOf("&page="));
  window.location = "http://localhost/write.php"+newUrl+"&type=edit"+ newUrl2;

}
function gotoDelete(){
  //alert("?");
  var r=confirm("Do you really want to delete this post?");
  if (r==true)
  {
    var s = window.location.toString();
    var newUrl = s.substring(s.indexOf("&post_id="+8), s.length);
    window.location = "http://localhost/delete.php?post_id="+newUrl;
  }
}

var button = document.getElementById("write");
if(button!=null){
  button.addEventListener("click", gotoWrite);
}

var delbt = document.getElementById("delete");
if(delbt!=null){
  delbt.addEventListener("click", gotoDelete);

  var edibt = document.getElementById("edit");
  edibt.addEventListener("click", gotoEdit);
}
