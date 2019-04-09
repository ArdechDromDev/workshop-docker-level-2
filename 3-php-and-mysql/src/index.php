<?php

$majorProblems = [];
$noProblems = [];

// Check 1

try{
    $dbh = new pdo('mysql:host='.$_ENV['MYSQL_HOST'].';dbname='.$_ENV['MYSQL_DBNAME'],
    $_ENV['MYSQL_LOGIN'],
    $_ENV['MYSQL_PASSWORD'],
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $noProblems['BDD ok.'] = '';
}
catch(PDOException $ex){
    $majorProblems['Connexion BDD impossible.'] = $ex->getMessage();
}

// Check 2

if(is_dir('./uploads')){
    $noProblems['Dossier ./uploads ok.'] = '';
} else {
    $majorProblems['Dossier ./uploads'] = 'Impossible de lire le dossier.';
}

// Count problems

$hasMajorProblems = count($majorProblems);
$hasNoProblems = count($noProblems);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="robots" content="noindex,nofollow" />
        <title>Symfony Configuration Checker</title>
        <style>
            /* styles copied from symfony framework bundle */
            html {
                background: #eee;
            }
            body {
                font: 11px Verdana, Arial, sans-serif;
                color: #333;
            }
            .sf-reset, .sf-reset .block, .sf-reset #message {
                margin: auto;
            }
            img {
                border: 0;
            }
            .clear {
                clear: both;
                height: 0;
                font-size: 0;
                line-height: 0;
            }
            .clear-fix:after {
                content: "\0020";
                display: block;
                height: 0;
                clear: both;
                visibility: hidden;
            }
            .clear-fix {
                display: inline-block;
            }
            * html .clear-fix {
                height: 1%;
            }
            .clear-fix {
                display: block;
            }
            .header {
                padding: 30px 30px 20px 30px;
            }
            .header-logo {
                float: left;
            }
            #content {
                width: 970px;
                margin: 0 auto;
            }
            #content pre {
                white-space: normal;
                font-family: Arial, Helvetica, sans-serif;
            }

            /*
            Copyright (c) 2010, Yahoo! Inc. All rights reserved.
            Code licensed under the BSD License:
            http://developer.yahoo.com/yui/license.html
            version: 3.1.2
            build: 56
            */
            .sf-reset div,.sf-reset dl,.sf-reset dt,.sf-reset dd,.sf-reset ul,.sf-reset ol,.sf-reset li,.sf-reset h1,.sf-reset h2,.sf-reset h3,.sf-reset h4,.sf-reset h5,.sf-reset h6,.sf-reset pre,.sf-reset code,.sf-reset form,.sf-reset fieldset,.sf-reset legend,.sf-reset input,.sf-reset textarea,.sf-reset p,.sf-reset blockquote,.sf-reset th,.sf-reset td{margin:0;padding:0;}.sf-reset table{border-collapse:collapse;border-spacing:0;}.sf-reset fieldset,.sf-reset img{border:0;}.sf-reset address,.sf-reset caption,.sf-reset cite,.sf-reset code,.sf-reset dfn,.sf-reset em,.sf-reset strong,.sf-reset th,.sf-reset var{font-style:normal;font-weight:normal;}.sf-reset caption,.sf-reset th{text-align:left;}.sf-reset h1,.sf-reset h2,.sf-reset h3,.sf-reset h4,.sf-reset h5,.sf-reset h6{font-size:100%;font-weight:normal;}.sf-reset q:before,.sf-reset q:after{content:'';}.sf-reset abbr,.sf-reset acronym{border:0;font-variant:normal;}.sf-reset sup{vertical-align:text-top;}.sf-reset sub{vertical-align:text-bottom;}.sf-reset input,.sf-reset textarea,.sf-reset select{font-family:inherit;font-size:inherit;font-weight:inherit;}.sf-reset input,.sf-reset textarea,.sf-reset select{font-size:100%;}.sf-reset legend{color:#000;}
            .sf-reset abbr {
                border-bottom: 1px dotted #000;
                cursor: help;
            }
            .sf-reset p {
                font-size: 14px;
                line-height: 20px;
                padding-bottom: 20px;
            }
            .sf-reset strong {
                color: #313131;
                font-weight: bold;
            }
            .sf-reset a {
                color: #6c6159;
            }
            .sf-reset a img {
                border: none;
            }
            .sf-reset a:hover {
                text-decoration: underline;
            }
            .sf-reset em {
                font-style: italic;
            }
            .sf-reset h2,
            .sf-reset h3 {
                font-weight: bold;
            }
            .sf-reset h1 {
                font-family: Georgia, "Times New Roman", Times, serif;
                font-size: 20px;
                color: #313131;
                word-wrap: break-word;
            }
            .sf-reset .block {
                -moz-border-radius: 16px;
                -webkit-border-radius: 16px;
                border-radius: 16px;
                margin-bottom: 20px;
                background-color: #FFFFFF;
                border: 1px solid #dfdfdf;
                padding: 40px 50px;
                word-break: break-all;
            }
            .sf-reset h2 {
                font-size: 16px;
                font-family: Arial, Helvetica, sans-serif;
            }
            .sf-reset li a {
                background: none;
                color: #868686;
                text-decoration: none;
            }
            .sf-reset li a:hover {
                background: none;
                color: #313131;
                text-decoration: underline;
            }
            .sf-reset ol {
                padding: 10px 0;
            }
            .sf-reset ol li {
                list-style: decimal;
                margin-left: 20px;
                padding: 2px;
                padding-bottom: 20px;
            }
            .sf-reset ol ol li {
                list-style-position: inside;
                margin-left: 0;
                white-space: nowrap;
                font-size: 12px;
                padding-bottom: 0;
            }
            .sf-reset li .selected {
                background-color: #ffd;
            }
            .sf-button {
                display: -moz-inline-box;
                display: inline-block;
                text-align: center;
                vertical-align: middle;
                border: 0;
                background: transparent none;
                text-transform: uppercase;
                cursor: pointer;
                font: bold 11px Arial, Helvetica, sans-serif;
            }
            .sf-button span {
                text-decoration: none;
                display: block;
                height: 28px;
                float: left;
            }
            .sf-button .border-l {
                text-decoration: none;
                display: block;
                height: 28px;
                float: left;
                padding: 0 0 0 7px;
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAcCAYAAACtQ6WLAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQtJREFUeNpiPHnyJAMakARiByDWYEGT8ADiYGVlZStubm5xlv///4MEQYoKZGRkQkRERLRYWVl5wYJQyXBZWdkwCQkJUxAHKgaWlAHSLqKiosb//v1DsYMFKGCvoqJiDmQzwXTAJYECulxcXNLoumCSoszMzDzoumDGghQwYZUECWIzkrAkSIIGOmlkLI10AiX//P379x8jIyMTNmPf/v79+ysLCwsvuiQoNi5//fr1Kch4dAyS3P/gwYMTQBP+wxwHw0xA4gkQ73v9+vUZdJ2w1Lf82bNn4iCHCQoKasHsZw4ODgbRIL8c+/Lly5M3b978Y2dn5wC6npkFLXnsAOKLjx49AmUHLYAAAwBoQubG016R5wAAAABJRU5ErkJggg==) no-repeat top left;
            }
            .sf-button .border-r {
                padding: 0 7px 0 0;
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAcCAYAAACtQ6WLAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAR1JREFUeNpiPHnyZCMDA8MNID5gZmb2nAEJMH7//v3N169fX969e/cYkL8WqGAHXPLv37//QYzfv39/fvPmzbUnT56sAXInmJub/2H5/x8sx8DCwsIrISFhDmQyPX78+CmQXs70798/BmQsKipqBNTgdvz4cWkmkE5kDATMioqKZkCFdiwg1eiAi4tLGqhQF24nMmBmZuYEigth1QkEbEBxTlySYPvJkwSJ00AnjYylgU6gxB8g/oFVEphkvgLF32KNMmCCewYUv4qhEyj47+HDhyeBzIMYOoEp8CxQw56wsLAncJ1//vz5/P79+2svX74EJc2V4BT58+fPd8CE/QKYHMGJOiIiAp6oWW7evDkNSF8DZYfIyEiU7AAQYACJ2vxVdJW4eQAAAABJRU5ErkJggg==) right top no-repeat;
            }
            .sf-button .btn-bg {
                padding: 0 14px;
                color: #636363;
                line-height: 28px;
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAcCAYAAACgXdXMAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAClJREFUeNpiPnny5EKGf//+/Wf6//8/A4QAcrGzKCZwGc9sa2urBBBgAIbDUoYVp9lmAAAAAElFTkSuQmCC) repeat-x top left;
            }
            .sf-button:hover .border-l,
            .sf-button-selected .border-l {
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAcCAYAAACtQ6WLAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAR9JREFUeNpi/P//PwMyOHfunDqQSgNiexZkibNnzxYBqZa3HOs5v7PcYQBLnjlzhg1IbfzIdsTjA/t+ht9Mr8GKwZL//v3r+sB+0OMN+zqIEf8gFMvJkyd1gXTOa9YNDP//otrPAtSV/Jp9HfPff78Z0AEL0LUeXxivMfxD0wXTqfjj/2ugkf+wSrL9/YtpJEyS4S8WI5Ek/+GR/POPFjr//cenE6/kP9q4Fo/kr39/mdj+M/zFkGQCSj5i+ccPjLJ/GBgkuYOHQR1sNDpmAkb2LBmWwL///zKCIxwZM0VHR18G6p4uxeLLAA4tJMwEshiou1iMxXaHLGswA+t/YbhORuQUv2DBAnCifvxzI+enP3dQJUFg/vz5sOzgBBBgAPxX9j0YnH4JAAAAAElFTkSuQmCC) no-repeat top left;
            }
            .sf-button:hover .border-r,
            .sf-button-selected .border-r {
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAcCAYAAACtQ6WLAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAT5JREFUeNpiPHv27BkGBoaDQDzLyMjoJgMSYHrM3WX8hn1d0f///88DFRYhSzIuv2X5H8Rg/SfKIPDTkYH/l80OINffxMTkF9O/f/8ZQPgnwyuGl+wrGd6x7vf49+9fO9jYf3+Bkkj4NesmBqAV+SdPntQC6vzHgIz//gOawbqOGchOxtAJwp8Zr4F0e7D8/fuPAR38/P8eZIo0yz8skv8YvoIk+YE6/zNgAyD7sRqLkPzzjxY6/+HS+R+fTkZ8djLh08lCUCcuSWawJGbwMTGwg7zyBatX2Bj5QZKPsBrLzaICktzN8g/NWEYGZgYZjoC/wMiei5FMpFh8QPSU6Ojoy3Cd7EwiDBJsDgxiLNY7gLrKQGIsHAxSDHxAO2TZ/b8D+TVxcXF9MCtYtLiKLgDpfUDVsxITE1GyA0CAAQA2E/N8VuHyAAAAAABJRU5ErkJggg==) right top no-repeat;
            }
            .sf-button:hover .btn-bg,
            .sf-button-selected .btn-bg {
                color: #FFFFFF;
                text-shadow:0 1px 1px #6b9311;
                background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAcCAIAAAAvP0KbAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAEFJREFUeNpiPnv2LNMdvlymf///M/37B8R/QfQ/MP33L4j+B6Qh7L9//sHpf2h8MA1V+w/KRjYLaDaLCU8vQIABAFO3TxZriO4yAAAAAElFTkSuQmCC) repeat-x top left;
            }

            /* styles copied from bundles/sensiodistribution/webconfigurator/css/install.css */
            body {
                font-size: 14px;
                font-family: "Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
            }
            .sf-reset h1.title {
                font-size: 45px;
                padding-bottom: 30px;
            }
            .sf-reset h2 {
                font-weight: bold;
                color: #FFFFFF;
                /* Font is reset to sans-serif (like body) */
                font-family: "Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
                margin-bottom: 10px;
                background-color: #aacd4e;
                padding: 2px 4px;
                display: inline-block;
                text-transform: uppercase;
            }
            .sf-reset ul a,
            .sf-reset ul a:hover {
                background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAICAYAAAAx8TU7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAFdJREFUeNpiYACBjjOhDEiACSggCKTLgXQ5TJARqhIkcReIKxgqTGYxwvV0nDEGkmeAOIwJySiQ4HsgvseIpGo3ELsCtZ9lRDIvDCiwhwHJPEFkJwEEGACq6hdnax8y1AAAAABJRU5ErkJggg==) no-repeat right 7px;
                padding-right: 10px;
            }
            .sf-reset ul, ol {
                padding-left: 20px;
            }
            .sf-reset li {
                padding-bottom: 18px;
            }
            .sf-reset ol li {
                list-style-type: decimal;
            }
            .sf-reset .symfony-blocks-install {
                overflow: hidden;
            }
            .sf-reset .symfony-install-continue {
                font-size: 0.95em;
                padding-left: 0;
            }
            .sf-reset .symfony-install-continue li {
                padding-bottom: 10px;
            }
            .sf-reset .ok {
                color: #fff;
                font-family: "Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
                background-color: #6d6;
                padding: 10px;
                margin-bottom: 20px;
            }
            .sf-reset .ko {
                background-color: #d66;
            }
            .sf-reset p.help {
                padding: 12px 16px;
                word-break: break-word;
            }
            .version {
                text-align: right;
                font-size: 10px;
                margin-right: 20px;
            }
            .sf-reset a,
            .sf-reset li a {
                color: #08C;
                text-decoration: none;
            }
            .sf-reset a:hover,
            .sf-reset li a:hover {
                color: #08C;
                text-decoration: underline;
            }
            .sf-reset textarea {
                padding: 7px;
            }
        </style>
    </head>
    <body>
        <div id="content">
            <div class="sf-reset">
                <div class="block">
                    <div class="symfony-block-content">
                        <h1 class="title">Configuration Checker</h1>
                        <p>
                            This script analyzes your system to check whether is
                            ready to run applications.
                        </p>

                        <?php if ($hasMajorProblems): ?>
                            <h2 class="ko">Ça marche pas :'(</h2>
                            <p>Ces problèmes doivent être résolu :</p>
                            <ol>
                                <?php foreach ($majorProblems as $problemKey => $valueProblem): ?>
                                    <li><?php echo $problemKey ?>
                                        <p class="help"><em><?= $valueProblem ?></em></p>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        <?php endif; ?>

                        <?php if ($hasNoProblems): ?>
                            <h2 class="ok">Validé</h2>
                            <ul>
                                <?php foreach ($noProblems as $problemKey => $valueProblem): ?>
                                    <li><?= $problemKey ?></li>
                                <?php endforeach; ?>
                            </ol>
            			<?php endif; ?>

                        <h1 class="title">Variables d'environments</h1>

                        <table>
                            <?php foreach($_ENV as $key => $value): ?>
                            <tr><th><?= $key ?></th><td><?= $value ?></td></tr>
                            <?php endforeach; ?>
                        </table>

                        <h1 class="title">Photos</h1>

                        <?php foreach(glob('./uploads/*') as $image): ?>
                            <img src="<?= $image ?>" width="20%">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
