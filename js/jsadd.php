<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
?>
<script language="JavaScript">
      $(document).ready(function(){
        $(".Filtre_status").click(function(){
            var status = $(this).attr('data-status');
            hideornot(this,status);
        });

          $( ".targetName" ).change(function() {

             // alert( $(this).val());
          });

   });

    var hideTag = [];
    function hideornot(trItem,tag)
    {
        if (hideTag.indexOf(tag) != '-1')
        {
            var index = hideTag.indexOf(tag);
            hideTag.splice(index, 1);
            $( "tr." + tag ).show();
            $(trItem).css('color', 'white');
            $(trItem).css('background-color', 'rgba(0, 0, 0, 0.1)');

        }
        else
        {
            $( "tr." + tag ).hide();
            hideTag.push(tag);
            $(trItem).css('color', 'red');
            $(trItem).css('background-color', 'rgba(255, 255, 255, 0.6)');

        }
    }

    findPlayer()
      {

      }



</script>
