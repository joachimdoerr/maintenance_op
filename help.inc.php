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

?>

<h2 style="margin-bottom:10px;">Maintenance Operations Addon für Redaxo | 13.11.2011 | Ver. 1.1.2</h2>
<h3 style="margin:10px 0 0 0">Systemvoraussetzungen</h3>
<p>Dieses Addon kann eingesetzt werden ab Redaxo 4.2 es benötigt min. PHP Version 5.2</p>
<h3 style="margin:10px 0 0 0">Installation</h3>
<p>Die installation des Maintenance Operations Addon unterscheidet sich nicht von der Installation andere Addons: </p>
<ol style="margin-left:20px;">
<li>Entpacken Sie das Packet und legen Sie dessen Inhalt in das Addonverzeichnis von Redaxo &quot;redaxo/include/addons/&quot; ab.</li>
<li>Installieren und aktivieren Sie das Addon in Redaxo unter &quot;Addons&quot;.</li>
</ol>
<h3 style="margin:10px 0 0 0">Mögliche Fehler und deren Lösung</h3>
<p>Die bis jetzt bekannten Fehler:</p>
<ol style="margin-left:20px;">
<li>Die Installation ist nicht möglich wegen fehlende Schreib- oder Ausführrechte der Ordner
<ul style="margin-left:20px;">
<li>&quot;redaxo/include/addons/maintenance_op&quot;</li>
<li>&quot;files/addons&quot;</li>
</ul>
</li>
</ol>
<p>Die Lösung ist jeweils die selbe, prüfen Sie die Berechtigungen der Ordner und erteilen Sie je nach Servereinstellung Rechte von 755 bis 777.</p>
<h3 style="margin:10px 0 0 0">Wofür kann ich Maintenance Operations nutzen</h3>
<p>Durch das Addon ist es schnell und einfach möglich die gesamte Webseite offline zu schalten. Sobald die Seite offline geschaltet wurde ist sie nur noch für einen in Redaxo eingeloggten Benutzer sichtbar. Es ist möglich ein Template zu wählen welches dann ausgegeben werden soll, wurde in der Konfiguration kein Template gewähl gibt das Addon seine Standard Seite für den Offline Status aus.</p>