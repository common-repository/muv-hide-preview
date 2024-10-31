=== muv - Hide Preview ===
Contributors: meinsundvogel
Plugin URI: https://wordpress.org/plugins/muv-hide-preview
Stable tag: 1.7.1
Tags: verstecken, rechtssicherheit, unbefugter zugriff, preview, entwicklung, unsichtbar, ausblenden, freischalten, anzeigen, coming-soon, schutz, schützen, projekte, multisite
Requires at least: 4.7
Tested up to: 5.4.2
Requires PHP: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Versteckt in der Entwicklungsphase befindende einzelne Seiten, Unterordner oder auch ganze Websites vor den Augen nicht befugter Dritter!

== Description ==
Die Ausführliche Dokumentation unseres Plugins finden Sie unter: [https://doc.muv.com/wordpress/hide-preview](https://doc.muv.com/wordpress/hide-preview)



**Welche Werbeagentur, welcher Web-Designer, welcher Freelancer kennt das nicht:**
**Der Kunde möchte immer über den aktuellsten Stand seines WordPress-Projektes informiert sein und jeden Tag den Fortschritt sehen können.**

Aus diesem Grunde richtet fast jeder, der für einen Kunden WordPress-Projekte realisiert, einen Preview-Server oder einen Preview-Bereich für seine Kundenprojekte ein.

Nun kann der Kunde / Auftraggeber zwar jederzeit die laufenden Projekte einsehen, aber jeder andere kann dies auch.

**Erschwerend kommt hinzu, dass es nach deutschem Recht möglich ist, diese - im entstehen befindlichen - Projekte aufgrund eines fehlerhaften Impressums, aufgrund fehlender oder falscher AGB, usw. abzumahnen. Dies ist in der Praxis auch schon vorgekommen!**

Hier setzt unser Plugin an:
Im Gegensatz zu "herkömmlichen" Coming-Soon Plugins, welche eine plakative "hier kommt gleich was" - Seite anzeigen (und den restlichen Auftritt KOMPLETT verbergen) wurde unser Plugin dafür geschrieben, entweder **den gesamten Internet-Auftritt** oder auch nur **einzelnen Teile** davon (z.B. eine Seite oder ein Unterverzeichnis) vor dem Zugriff unbefugter Augen zu schützen.

Die API von WordPress oder auch einzelner Plugins ist davon NICHT betroffen. D.h. eine entstehende Schnittstelle zu einem Warenwirtschaftssystem kann z.B. weiterhin getestet werden.

Ebenfalls im Gegensatz zu herkömmlichen Coming-Soon Plugins wird der Zugriff auf die geschützten Bereiche nicht über einen erfolgten Login, sondern über eine spezielle (auf Wunsch wechselnde) Freischalt-Seite.

D.h. nach dem Besuch dieser speziellen Seite können die geschützten Bereiche eingesehen werden.

Dies ist z.B. dann sinnvoll, wenn die entstehende Seite selber ein Login besitzt, denn:

Wie soll getestet werden, was ein nicht angemeldeter User sehen und wie er sich am System anmelden kann, wenn er diese Seiter erst nach erfolgtem Login sehen kann, da sie bis dahin von dem Coming-Soon Plugin verborgen sind.

Da Preview-Server oft als Multisite-Installationen realisiert werden wird dies von unserem Plugin ebenfalls unterstützt. D.h. für jede einzelne Website wird ein eigener Freischalt-Link (eine eigene Freischalt-Seite) erstellt.

WICHTIGER HINWEIS:
Sollten beim Speichern der Einstellungen Probleme auftreten, so lesen Sie bitte
**Wenn ich die Einstellungen speichern möchte, erscheint eine “komische” Seite und die Einstellungen werden NICHT gespeichert. Woran kann das liegen?** innerhalb der FAQ.

= So einfach werden Bereiche geschützt =
Das Plugin fügt im Admin-Bereich ein eigenes Menü "Hide Preview" ein.

Klicken Sie dort auf den Menüpunkt "Einstellungen".

Aktivieren Sie (im Reiter Verstecken) die Checkbox "Verstecken der nicht öffentlichen Bereiche aktivieren"

Das war alles. Ihr kompletter Internet-Auftritt ist nun geschützt (Der Login und der Admin-Bereich sind davon selbstverständlich nicht betroffen).

Im Reiter "Anzeige freischalten" finden Sie den Freischalt-Link.

Nachdem Sie diesen Link besucht haben, sind die geschützten Bereiche wieder freigeschaltet (bis Sie den Browser schließen).


== Installation ==
1. Entpacken Sie die ZIP-Datei und laden Sie den Ordner muv-hide-preview in das Plugin-Verzeichnis von WordPress hoch: wp-content/plugins/.
2. Loggen Sie sich dann als Admin unter WordPress ein. Unter dem Menüpunkt "Plugins" können Sie "muv - Hide Preview" nun aktivieren.

Weitere Informationen finden Sie unter: [https://doc.muv.com/wordpress/hide-preview](https://doc.muv.com/wordpress/hide-preview)

== Upgrade Notice ==
Sämtliche Plugin-Versionen sind untereinander kompatibel.
Bei einem Update ist also nichts weiter zu beachten.
Es gehen weder Daten verloren, noch müssen Einstellungen neu eingegeben werden.

== Frequently Asked Questions ==

= Wenn ich die Einstellungen speichern möchte, erscheint eine "komische" Seite und die Einstellungen werden NICHT gespeichert. Woran kann das liegen? ==
Bitte überprüfen Sie zuerst, ob es funktioniert, wenn Sie andere Plugins deaktivieren.

Wir haben z.B. festgestellt, dass das beliebte Plugin '404 to 301' solche Störungen verursacht. Wir haben dies bereits den Entwicklern mitgeteilt und hoffen, dass diese dies in Zukunft beheben.

= Wie kann mein Kunde die geschützten Bereiche freischalten? =
Senden Sie ihm einfach den Freischalt-Link per Mail zu. Sobald der Kunde diesen Link angeklickt (d.h. die Seite besucht) hat, ist er freigeschaltet.

= Wie kann einzelne Bereiche / einzelne Seiten schützen? =
Geben Sie die zu schützende URL in das Eingabefeld ein. Eine URL ist eine Zeile.
Also z.B.
--
/blog
/einkaufen/adresse
--

um diese beiden Bereiche zu schützen. Alle anderen Bereiche bleiben weiterhin sichtbar.

= Unterstützt das Plugin Multisite Installationen? =
Ja, das Plugin wurde Multisite-kompatibel programmiert.
Für jede einzelne Website wird ein eigener separater Freischalt-Link erzeugt der nicht für die anderen Sites verwendet werden kann.
Die netzwerkweite Aktivierung wird ebenso unterstützt wie die Aktivierung für einzelne Websites.
Bei netzwerkweiter Aktivierung wird für jede nachträglich hinzugefügten Website automatisch ein separater Freischalt-Link erzeugt.

== Changelog ==

= 1.7.1 =
Veröffentlicht am: 20.07.2020

* Fehlerbehebungen:
    * Der `Webiste-Zustand` wurde immer noch bei vereinzelten WordPress-Instanzen felerhaft angezeigt. Dieses Problem ist nun auch behoben.

= 1.7.0 =
Veröffentlicht am: 15.07.2020

* Fehlerbehebungen:
    * Bei aktiviertem Plugin wurden innerhalb des `Website-Zustand` - Fensters Fehler bei der **Loopback-Anfrage**, bei der **Rest-API** und bei den **Hintergrund-Updates** angezeigt.

= 1.6.1 =
Veröffentlicht am: 14.03.2019

* Fehlerbehebungen:
    * Fehler beim Einbinden von Font Awesome behoben.
    * Wenn eine interne Seite als Anzeige ausgewählt wurde, konnte es bei manchen Server-Konfigurationen beim Aufruf
      einiger Seiten zur Ausgabe einer leeren (anstelle der ausgewählten) Seite kommen.

= 1.6.0 =
Veröffentlicht am: 11.03.2019

* Verbesserungen:
    * Font Awesome auf Version 5 abgeändert.
    * Ab sofort kann eine `interne Seite` als Seite verwendet werden, die als Sperrseite angezeigt werden soll.

= 1.5.0 =
Veröffentlicht am: 21.08.2017

* Verbesserungen:
    * Kompatibilität für Multisite - Installationen hinzugefügt
    * Das Handling der "/" innerhalb der angegebenen (Teil)-URL verbessert.
    * Angemeldete Admin können sämtliche Seiten sehen ohne vorher der Freischalt-Link anklicken zu müssen. Dies vereinfacht die Entwicklung neuer Seiten.

* Fehlerbehebungen:
    * Fehler beim neu Erstellen des Freischalt-Links behoben (header already send)
    * Die Optionen werden nun beim Deinstallieren komplett gelöscht

= 1.0.1 =
Veröffentlicht am: 10.04.2017

* Design an weitere Plugins von muv angepasst.


= 1.0.0 =

Veröffentlicht am: 10.04.2017

* Erstes Release

