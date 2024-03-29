=== Custom PDF-File Upload to Folder ===
Contributors: Hans-Gerd Gerhards, haurand.com
=== Custom PDF-File Upload to Folder ===
Author URI: https://haurand.com
Plugin URI: https://haurand.com
Donate link: 
Contributors: Hans-Gerd Gerhards, haurand.com
Tags: 
Requires at least: 5.0
Tested up to: 6.4.2
Requires PHP: 8.0
Stable tag: 0.3.2
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html


== Description ==

A plugin to upload PDF-Files to a custom folder and post automatic per shortcode PDF-Files as link

Weitere Optionen:
1. Das Plugin sollte so erweitert werden, dass jeweils ein Link für die vorherige, aktuelle und nächste Woche gezeigt wird, wenn die Datei vorhanden ist.
	> erledigt
2. Das Plugin sollte einen Button für den Link erstellen, der per CSS-Regel entsprechend dargestellt wird. 
	> erledigt
3. Das Plugin sollte abfangen, wenn eine Datei nicht vorhanden ist.
	> erledigt
4. Es sollte ein Ordner nur für den Upload der PDF-Dateien (wochenplan) gewählt werden können
	> erledigt
5. für berechtigte Rollen muss eine Option zum Hochladen der Datei geschaffen werden.


== change log ==

25.1.2024: Version 0.3.2
			Wochenpläne wurden nicht korrekt für jede Woche ausgegeben
			Typecasting fehlte und echo hatte ich fälschlicherweise nicht auskommentiert.

5.1.2024: Version 0.3.1
			Änderungen am Backend: 
			- Jetzt wird zusätzlich der Name der Datei gezeigt, der hochgeladen werden soll.
			- Zusätzliche Anzeige des Ordners, in den die Datei hochgeladen wird.
			- Klasse description für Absatz entfernt

8.6.2023: Version 0.2.4
			Änderungen beim Upload (Text)
			Es wird nur noch der aktuelle und nächste Wochenplan angezeigt.
			
29.5.2023: Version 0.2.2
		   Für die Ordnerbezeichnung sind jetzt kleine Buchstaben, Ziffern, Unterstrich und Bindestrich zugelassen.

28.5.2023: Version 0.2.1
		   Über das "pattern"-Attribut werden nur 4-12 kleine Buchstaben als Ordnername zugelassen

28.5.2023: Version 0.2
		   Zusätzliche Option: Ordnername selbst wählen

28.5.2023: Version 0.1.1
		   Upload-Möglichkeit mit Menüpunkt im Backend
		   Korrekturen am Design im Dashboard

24.5.2023: Button-Beschriftung geändert. CSS-Klassen für gefundene und nicht gefundene Dateien. Dadurch bessere Darstellung möglich.

22.5.2023: Warnung "$out nicht definiert" korrigiert.


== Evtl. hilfreiche Links und Plugins: ==
https://stackoverflow.com/questions/7684771/how-to-check-if-a-file-exists-from-a-url
https://wordpress.org/plugins/custom-upload-folder/
https://stackoverflow.com/questions/70715768/wordpress-specify-a-custom-upload-folder-for-a-plugin
https://stackoverflow.com/questions/35147099/wordpress-upload-media-in-a-specific-folder-for-a-special-post
https://stackoverflow.com/questions/10444059/file-exists-returns-false-even-if-file-exist-remote-url
