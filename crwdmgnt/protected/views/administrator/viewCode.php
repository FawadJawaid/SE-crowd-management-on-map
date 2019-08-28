<?php include('header.php'); ?>
<div class="container-fluid" id="main-body">
    <h2 id="in-main-h1">View Widget</h2>
    <div id="widgetform" >
        <p>Web Url: </p><p><a href="<?php echo $webData->web_url; ?>"><?php echo $webData->web_url; ?></a></p>
        <p>Web Type: </p><p><?php echo $webData->web_type; ?></p>

        <p>Code :</p> <textarea id="textareaset" rows="25" cols="100" disabled="yes">
        <script language="Javascript">
            var HttpClient = function() {
                this.get = function(aUrl, aCallback) {
                    anHttpRequest = new XMLHttpRequest();
                    anHttpRequest.onreadystatechange = function() {
                        if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                            aCallback(anHttpRequest.responseText);
                    }
                    anHttpRequest.open("GET", aUrl, true);
                    anHttpRequest.send(null);
                }
            }
            aClient = new HttpClient();
            aClient.get('http://wiredservices.com.au/crwdmgnt/index.php?r=DataFetcher/Get' + "&id=<?php echo $webData->unq_id; ?>"
                    , function(answer) {
            });
            </script></textarea>

    </div>





    <br><br><br><br><br><br>
</div>


</div>





<?php include('footer.php'); ?>




