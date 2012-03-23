<?php

/**
 * Maintenance Operations
 *
 * @copyright Copyright (c) 2011 by Doerr Softwaredevelopment
 * @author mail[at]joachim-doerr[dot]com Joachim Doerr
 *
 * @package redaxo4
 * @version $Id$
 */

$mypage = 'maintenance_op';

$REX['ADDON']['rxid'][$mypage]        = 'maintenance_op';
$REX['ADDON']['page'][$mypage]        = $mypage;
$REX['ADDON']['name'][$mypage]        = 'Maintenance OP';
$REX['ADDON']['perm'][$mypage]        = 'maintenance_op[]';
$REX['ADDON']['version'][$mypage]     = '1.1.2';
$REX['ADDON']['author'][$mypage]      = 'Joachim Doerr';
$REX['ADDON']['supportpage'][$mypage] = 'http://formu.redaxo.de';
$REX['ADDON']['perm'][$mypage]        = $mypage.'[]';
$REX['PERM'][]                        = $mypage.'[]';

// --- DYN
$REX["ADDON"]["maintenance_op"]["settings"]["status"] = 0;
$REX["ADDON"]["maintenance_op"]["settings"]["template_id"] = 0;
// --- /DYN

if ($REX['ADDON'][$mypage]['settings']['status'] == 1) {
  if ($REX['REDAXO'])
    rex_register_extension('OUTPUT_FILTER', 'maintenance_backend');
  else
    rex_register_extension('OUTPUT_FILTER', 'maintenance_frontend');
}

function maintenance_frontend($params) {
  global $REX;
  session_start();
  $session = $_SESSION[$REX['INSTNAME']];
  
  if (!$session or !isset($session['STAMP']) or !isset($session['UID']) or $session['STAMP'] < (time() - $REX['SESSION_DURATION'])) {
    if($REX["ADDON"]["maintenance_op"]["settings"]["template_id"] > 0) {
      ob_start();
      ob_implicit_flush(0);
      $mop_template = new rex_template();
      $mop_template->setId($REX["ADDON"]["maintenance_op"]["settings"]["template_id"]);
      $tplContent = $mop_template->getTemplate();
      eval("?>".$tplContent);
      $output = ob_get_contents();
      ob_end_clean();
      return $output;
    } else
      require_once $REX['INCLUDE_PATH'].'/addons/maintenance_op/templates/offsite.tmp.php';

    return exit;
  }
}

function maintenance_backend($params) {
  $output = <<<EOT
    <style type="text/css">
      #mnc-headline {
        margin-top:10px;
        text-align:left;
        width:100%;
        display:block;
        clear:both;
        height:50px;
        color:#000;
        font-size:12px;
        font-family:Lucida Sans Unicode, Lucida Grande,sans-serif;
        background-color:#FAE9E5
      }
      #mnc-headline span {
        display:block;
        padding:20px 20px 20px 60px;
        background:transparent url(../files/addons/maintenance_op/software-update-urgent.png) no-repeat 20px 10px;width:960px;
        filter:alpha(opacity=98);opacity:0.98;-moz-opacity:0.98;
        color:#EA1144;
      }
    </style>
    <div id="mnc-headline">
      <span>Die Website ist "Down for Maintenance" - Bearbeiten Sie die <a href="index.php?page=maintenance_op">MOP Settings</a> um diesen Status aufzuheben.</span>
    </div>
EOT;
  
  $inhalt = $params['subject'];
  $inhalt = preg_replace("/(<div id=\"rex-output.*?.\>)/i",$output.'$1',$inhalt);
  return $inhalt;
}
