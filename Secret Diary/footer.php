<script type="text/javascript">
    $(".login").click(function(){
      $("#signupform").toggle();
      $("#loginform").toggle();
    });
    
    $('#texta').bind('input propertychange', function() {
        $.ajax({
              method: "POST",
              url: "updatedatabase.php",
              data: { content : $("#texta").val() }
            })
    });
    
    $("#texta").height($(window).height() - $("nav").height() - 40);


    
    
  </script>

</body>
</html>