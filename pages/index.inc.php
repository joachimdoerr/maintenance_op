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

$mypage    = rex_request('page', 'string');
$subpage   = rex_request('subpage', 'string');
$status    = rex_request('status', 'string');
$func      = rex_request('func', 'string');

require $REX['INCLUDE_PATH'] . '/layout/top.php';
rex_title('Maintenance Operation');

if ($func == 'savesettings') {
  $content = '';
  foreach ($_GET as $key => $val) {
    if (!in_array($key,array('page','subpage','minorpage','func','submit','PHPSESSID'))) {
      $REX['ADDON'][$mypage]['settings'][$key] = $val;
      if (is_numeric($val))
        $content .= '$REX["ADDON"]["'.$mypage.'"]["settings"]["'.$key.'"] = '.$val.';'."\n";
      else
        $content .= '$REX["ADDON"]["'.$mypage.'"]["settings"]["'.$key.'"] = \''.$val.'\';'."\n";
    }
  }
  $file = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  if($status==1)
    echo rex_warning('Einstellungen wurden gespeichert. Site is down for Maintenance.');
  else
    echo rex_info('Einstellungen wurden gespeichert.');
}

$tmp = new rex_select();
$tmp->setSize(1);
$tmp->setName('status');
$tmp->addOption('Site is online',0);
$tmp->addOption('Site is down for Maintenance',1);
$tmp->setSelected($REX['ADDON'][$mypage]['settings']['status']);
$select = $tmp->get();

$set_tmp = new rex_select();
$set_tmp->setSize(1);
$set_tmp->setName('template_id');
$set_tmp->setSelected($REX['ADDON'][$mypage]['settings']['template_id']);
$set_tmp->addOption('---', 0);
$qry = 'SELECT name as label,id FROM rex_template';
$set_tmp->addSqlOptions($qry);

if($REX['ADDON'][$mypage]['settings']['status']==0)
  echo rex_info('Site is online.') . '<style type="text/css">#mnc-headline {display:none;}</style>';

echo '
<div class="rex-addon-output">
  <div class="rex-form">
  <form action="index.php" method="get" id="settings">
    <input type="hidden" name="page" value="'.$mypage.'" />
    <input type="hidden" name="subpage" value="'.$subpage.'" />
    <input type="hidden" name="func" value="savesettings" />
        <fieldset class="rex-form-col-1">
          <legend>Status</legend>
          <div class="rex-form-wrapper">
            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-select">
                <label for="select">Settings</label>
                '.$select.'
              </p>
            </div>
            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-select">
                <label for="select">Template (alternativ)</label>
                '.$set_tmp->get().'
              </p>
            </div>
            <div class="rex-form-row">
              <p class="rex-form-submit">
                <input class="rex-form-submit" type="submit" id="submit" name="submit" value="Einstellungen speichern" />
              </p>
            </div>
          </div>
        </fieldset>
  </form>
  </div>
</div>
';

require $REX['INCLUDE_PATH'] . '/layout/bottom.php';

