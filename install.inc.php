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

$error = '';

if ($error != '')
  $REX['ADDON']['installmsg']['maintenance_op'] = $error;
else
  $REX['ADDON']['install']['maintenance_op'] = true;
