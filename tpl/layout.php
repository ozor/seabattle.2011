<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Генерация расстановки кораблей для игры "Морской бой"</title>

        <script type="text/javascript" src="/js/jquery-1.4.3.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/css.css" />
    </head>
    <body>
        <div id="field">
            <?php $this->drawField(); ?>
        </div>
        <div id="button">
            <input type="button" value="Обновить" id="bttn_generate" />
        </div>
        <script type="text/javascript">
            $(function(){
                $("#bttn_generate").click(function() {
                    $.ajax({
                        url: "<?php echo self::AJAX_SCRIPT ?>",
                        success: function(msg){
                            $("#field").html(msg);
                        }
                    });
                });
            });
            </script>
    </body>
</html>
