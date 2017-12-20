   <span id="show_pomotion"></span>
   </p>
   <script type="text/javascript">
   function load_pomotion()
{
   	var xmlhttp;
if (window.XMLHttpRequest){
  xmlhttp=new XMLHttpRequest();
  }else{
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("show_pomotion").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","https://www.lnwphp.in.th/pomotion.php",true);
xmlhttp.send();
}
window.load_pomotion();
   </script>
   <script src="assets/jquery.min.js"></script>