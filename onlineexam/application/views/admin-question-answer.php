Please allow pop-up. And Provide correct answers for the selected section.<br />
<a href='<?php echo $rurl; ?>' id='go_link'>Go to Module Page</a>
<script>

    var url = '<?php echo $url; ?>';
    var title = '<?php echo $title; ?>';
    
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var w = width;
    var h = height;
    
    var systemZoom = width / window.screen.availWidth;
    var left = (width - w) / 2 / systemZoom + dualScreenLeft
    var top = (height - h) / 2 / systemZoom + dualScreenTop
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {newWindow.focus();}

    newWindow.onbeforeunload = function(){
        document.getElementById('go_link').click();
    }
    
</script>