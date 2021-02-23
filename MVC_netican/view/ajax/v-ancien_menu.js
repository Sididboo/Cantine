function ancien_menu() 
{

  if (window.XMLHttpRequest) 
  {
    // code for modern browsers
    var xmlhttp = new XMLHttpRequest();
  } 
  else
  {
    // code for old IE browsers
    var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() 
  {
    
    if (this.readyState == 4 && this.status == 200)
    {
      document.getElementById("tableAncienMenu").innerHTML = this.responseText;
    }
    
  };
  
  xmlhttp.open("GET", "controller/a-ancien_menu.php",true);
  xmlhttp.send();

}