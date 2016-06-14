=== betterplace.org ===
Contributors: kraej
Tags: betterplace, donation, charity
Tested up to: 4.5.2
License: GPL2
Stable Tag: 1.0

Mithilfe dieses Plugins können das offizielle betterplace.org Spendenformular sowie das Website-Widget in Deiner Wordpress-Seite eingebunden werden. Die Nutzung ist ganz einfach.


== Installation ==
Aus dem Wordpress Backend:
1. Gehe zu Plugins > Installieren
2. Suche nach „betterplace.org“
3. Installiere und aktiviere das Plugin

Von WordPress.org:
1. betterplace.org Plugin herunterladen
2. Lade das Plugin in Dein Plugin Verzeichnis hoch (\'/wp-content/plugins/\')
3. Aktiviere das Plugin in den Plugineinstellungen

Nach der Installation: 
Nachdem das Plugin aktiviert wurde, ist in der Menüleiste ein neuer Eintrag \"betterplace\" zu sehen. Über diesen Link kann das Plugin konfiguriert werden. 


== Frequently Asked Questions ==
= Wie kann ich das Widget einbauen? =
Das offizielle betterplace.org Widget kann auf zwei Arten in Deine Seite eingebunden werden:

1. Als Widget
Navigiere zu den Wordpress-Widgets (>Design >Widgets). Hier kannst Du das \"betterplace.org Widget\" auswählen. In den Widget Optionen kannst Du einen Titel (optional) sowie Deine Projekt ID (Pflicht) eingeben. 

2. Mit einem Shortcode
Das betterplace.org Widget kann an jeder beliebigen Stelle Deiner Wordpress-Seite durch Nutzen des Shortcodes ‘[betterplace-widget projekt=\"*Deine ID*\"]’ eingebunden werden. Wichtig ist die Angabe Deiner Projekt ID. Zusätzlich kannst Du mit dem Parameter \"width\" die Breite definieren: ‘[betterplace-widget projekt=\"*Deine ID*\" width=\"220\"]’. Ohne Angabe von width wird der Standard von betterplace.org genutzt.


= Wie kann ich das Spendenformular einbinden? =
Bitte konfiguriere auf der betterplace-Einstellungsseite das Plugin anhand deines betterplace-Projektes. Die Eingabe der Projekt ID ist Pflicht, da betterplace.org anderenfalls nicht das korrekte Formular laden kann. Alle weiteren Einstellungen sind optional. Wenn die Felder leer gelassen werden, werden die Standardeinstellungen von betterplace.org genutzt. 

Wenn alle Einstellungen gespeichert sind, kann das Spendenformular auf jeder beliebigen Seite durch Nutzen des Shortcodes ‘[betterplace-formular]’ eingebunden werden. 


== Changelog ==
1.0
Initial release.